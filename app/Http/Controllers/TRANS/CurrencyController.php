<?php

namespace App\Http\Controllers\TRANS;


use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{

    public function index(Request $request)
    {
        $data =  Currency::query()->get();
        return view('currency.index',compact('data'));
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

        return view('transaction.create');
    }
}
