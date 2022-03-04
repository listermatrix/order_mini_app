<?php
/**
 * Created by PhpStorm.
 * User: devport
 * Date: 1/2/17
 * Time: 9:16 AM
 */

namespace App\Http\Controllers;



use App\Models\AuditTrail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
//    use AuthenticatesUsers;

    public function getLogin() {
        return view('login');
    }

    public function postLogin(Request $request) {


            $this->validate($request, [
                'login' => 'required',
                'password' => 'required'
            ]);


        // get our login input
        $login = $request->input('login');

        // check login field
        $login_type = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';

        // merge our login field into the request with either email or username as key
        $request->merge([ $login_type => $login ]);

        $credentials = $request->only($login_type, 'password');

        //check the user trying to login
        if (isset($credentials['username']) && !empty($credentials['username']))
            $user = User::query()->where([
                ['username', '=', $credentials['username']]
            ])->first();
        else
            $user = User::query()->where([
                ['email', '=', $credentials['email']]
            ])->first();



        if (Auth::attempt($credentials))
        {
            $user = Auth::user();
            $user->last_login_date = Carbon::now();


            //update audit_trail
            AuditTrail::create([
                'user_id' => $user->id,
                'username' => $user->username,
                'date' => Carbon::now()->toDateTimeString(),
                'activity' => $user->username.' logged in '
            ]);


            return redirect()->route('transactions.index');

        } else {

            return Redirect::back()
                ->withInput($request->only('login', 'remember'))
                ->withErrors(['login' => Lang::get('auth.failed')]);
        }
    }


    public function logout(Request $request)
    {

        $_user = auth()->user();

        AuditTrail::create([
            'user_id' => $_user->id,
            'username' => $_user->username,
            'date' => Carbon::now()->toDateTimeString(),
            'activity' => $_user->username.' logged out '
        ]);

        auth()->logout();
        session()->flush();
        session()->invalidate();
        return redirect()->route('login');
    }

}
