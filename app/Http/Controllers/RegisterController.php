<?php
/**
 * Created by PhpStorm.
 * User: devport
 * Date: 1/2/17
 * Time: 9:16 AM
 */

namespace App\Http\Controllers;



use App\Models\Order;
use App\Models\AuditTrail;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{


    public function index(Request $request) {

        if($request->isMethod('post'))
        {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users',
                'password' => 'required',
            ]);


            DB::beginTransaction();

            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $user = User::query()->create($data);
            $this->seedAccount($user);

            DB::commit();

            Auth::login($user);

            return redirect()->route('transactions.index');
        }

        return view('register');
    }

    public function seedAccount($user)
    {
        $insert = [

              ['user_id' => $user->id, 'name' => 'USD ACC', 'currency_id' => (new DepartmentSeeder)->getCurrencyId('USD'), 'balance'=>1000.00,   'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
              ['user_id' => $user->id, 'name' => 'EUR ACC', 'currency_id' => (new DepartmentSeeder)->getCurrencyId('EUR'), 'balance'=>00.00,     'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
              ['user_id' => $user->id, 'name' => 'NGN ACC', 'currency_id' => (new DepartmentSeeder)->getCurrencyId('NGN'), 'balance'=>00.00,     'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]

        ];


        Order::query()->insert($insert);

    }



}
