<?php

namespace App\Http\Controllers\TRANS;


use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExchangeController extends Controller
{

    public function index(Request $request)
    {
        $data =  ExchangeRate::query()->get();
        return view('exchange.index',compact('data'));
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
