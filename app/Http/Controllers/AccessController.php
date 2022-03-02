<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function showLoginForm()
    {
      $var = 2+3;
        return view('test',compact('var'));
    }
}
