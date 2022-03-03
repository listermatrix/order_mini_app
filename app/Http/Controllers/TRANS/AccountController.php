<?php

namespace App\Http\Controllers\TRANS;


use App\Models\Account;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

    public function index(Request $request)
    {
        $user  = auth()->user();
        $data =  $user->account;
        return view('accounts.index',compact('data'));
    }



    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {
               $request->validate([
                   'user' =>'required',
                   'amount' =>'required'
               ]);
        }

        return view('accounts.create');
    }
}
