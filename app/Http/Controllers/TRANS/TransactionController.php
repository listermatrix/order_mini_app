<?php

namespace App\Http\Controllers\TRANS;

use App\AdmissionStatus;
use App\Applicant;
use App\DataTables\MscDataTable;
use App\Models\User;
use App\MscCurrentEmployer;
use App\MscEducationalBackground;
use App\MscEducationalHistory;
use App\MscExtraInfo;
use App\MscPersonalInformation;
use App\MscPreviousEmployer;
use App\MscRecommendationForm;
use App\MscReferee;
use App\Notifications\Alertify;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;

class TransactionController extends Controller
{

        public function index(Request $request)
        {
            $data = [
                'users' => User::query()->where('id','!=',auth()->user()->id)->get()
            ];
            return view('transaction.index',compact('data'));
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


        $data = (object)[
            'users'    => User::query()->where('id','!=',auth()->user()->id)->get(),
            'accounts' => auth()->user()->account,
        ];

        return view('transaction.create',compact('data'));
    }


    private  function mail_send($body, $head,$subject,$to,$from)
    {
        Notification::route('mail', $to)->notify(new Alertify($body, $head, $subject, $from));
    }


}
