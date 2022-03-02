<?php

namespace App\Http\Controllers;

use App\DataTables\AuditTrailDataTable;
use App\DataTables\SystemUsersDataTable;
use App\Notifications\Alertify;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function export()
    {
        $path = "";
        $cmd = "";
        $filePath  = shell_exec("$cmd $path");

        return response()->download($filePath)->deleteFileAfterSend();
    }


    public function index()
    {
        return view('admin.index');
    }

    public function audit(AuditTrailDataTable $auditTrail)
    {
        Auth::user()->log('VIEWED AUDIT TRAILS');
        return $auditTrail->render('admin.audit');
    }

    public function users(SystemUsersDataTable $users)
    {
        Auth::user()->log('VIEWED ADMIN USERS');
        return $users->render('admin.users.index');
    }



    public function create_user(Request $request)
    {
        if(strtoupper($request->method() == 'POST')):

            $this->validate($request,[
                'first_name' => 'required',
                'last_name' => 'required',
                'role' =>   'required',
                'email' => 'required|email|unique:users'
            ]);

            $data = $request->all();
            $data['role_id'] = $request->role;

            DB::beginTransaction();

            //generate username and password for staff
            $words = explode(" ", trim($data['first_name']).' '.trim($data['middle_name']));
            $acronym = "";
            foreach ($words as $w) {
                if($w && isset($w[0]) && !empty($w[0]))
                    $acronym .= $w[0];
            }
            $demo = strtolower($acronym.trim($data['last_name']));

            $password = substr(hash('sha512',rand()),0,6);

            $username =  $this->verifyUsername($demo);


            $data['username'] = $username;
            $data['password'] = bcrypt($password);

            $insert = User::query()->create($data);

$body ="Hello {$insert->getFullNameAttribute()},
Your username : {$username}
password : {$password}";

            $head = "Login Details";
            $subject = " Login credentials";
            $from = 'admission@cli.edu.com';
            $to = $insert->email;
            $this->mail_send($body,$head,$subject,$to,$from);

            Auth::user()->log("CREATED USER {$insert->getFullNameAttribute()}");
            DB::commit();

            return redirect()->route('system.users.index')->with('success','User, '.$insert->username.' Successfully Created');

        endif;


        $roles = Role::query()->get();
        return view('admin.users.create',compact('roles'));
    }

    public function edit_user(Request $request,$id)
    {
        $user = User::query()->find($id);

        if(strtoupper($request->method()) == 'POST'):

            $this->validate($request,[
                'first_name' => 'required',
                'last_name' => 'required',
                'role' =>    'required',
                'email' =>   'required|email|unique:users,email,'.$user->id
            ]);
            DB::beginTransaction();

            $data = $request->all();
            $data['role_id'] = $data['role'];

            $user->update($data);

            Auth::user()->log("EDITED THE USER DETAILS OF ".$user->username);

            DB::commit();

            return redirect()->route('system.users.index')->with('success','User, '.$user->username.' successfully updated');

        endif;

        $roles = Role::query()->get();
        return view('admin.users.edit',compact('roles','user'));
    }

    public function destroy_user($id)
    {
        $purge = User::query()->find($id);
        DB::beginTransaction();
        $purge->delete();
        Auth::user()->log("DELETD THE USER ".$purge->username);
        DB::commit();
        return redirect()->back()->with('success','User, '.$purge->username .' successfully deleted');

    }

    private function verifyUsername($string)
    {
        $length = 2;
        $query = User::query()->where('username',$string)->first();
        //if query returns true that means we ought to regenerate the user the name.

        //while $query remains true
        while($query):
            $random = substr(str_shuffle(str_repeat($x='0123456789',ceil($length/strlen($x)))),1,$length);
            $string = $string.$random;
            break;
        endwhile;

        return $string;
    }


    private  function mail_send($body, $head,$subject,$to,$from)
    {
        Notification::route('mail', $to)->notify(new Alertify($body, $head, $subject, $from));
    }

}
