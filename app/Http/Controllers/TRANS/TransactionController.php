<?php

namespace App\Http\Controllers\TRANS;

use App\AdmissionStatus;
use App\Applicant;
use App\DataTables\MscDataTable;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\Transaction;
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
            $user = auth()->user();
            $data = $user->sent;

            $data_2 = $user->received()->toArray();


            $merged  = array_merge($data->toArray(),$data_2);


            $trans = Transaction::hydrate($merged);


            return view('transaction.index',compact('trans'));
        }



    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {

               $request->validate([
                   'receiving_user' =>'required',
                   'account_id' =>'required',
                   'amount' =>'required',
                   'target_currency' =>'required'
               ]);


               $data = $request->all();

               $amount = $data['amount'];

               try {

                   /** sender information, source account type , source currency **/
                   $sender = auth()->user();
                   $source_account = $sender->account()->find($data['account_id']);
                   $source_currency = $source_account->currency->id;

                   if(!$this->checkAccounts($amount,$source_account))
                       return redirect()->back()->withInput()->withErrors('Insufficient balance !!!');


                   $target_currency = $data['target_currency'];

                   /** receiver information, receiver account type , target currency **/
                   $receiver = User::query()->find($data['receiving_user']);
                   $receiving_account = $receiver->account()->where('currency_id', $target_currency)->first();


                   //get exchange rate

                   $direct = ExchangeRate::query()->where('source_currency', $source_currency)
                       ->where('target_currency', $target_currency)->first();


                   $rate = 1;

                   if($source_currency !== $target_currency) {

                       if ($direct) {
                           $rate = $direct->rate;
                       }
                       else {
                           $reverse = ExchangeRate::query()->where('source_currency', $target_currency)
                               ->where('target_currency', $source_currency)->first();

                           if (!$reverse)
                               return redirect()->back()->withInput()->withErrors('Required Exchange rate is not configured !!!');

                           $rate = $reverse->inverse;
                       }

                   }



                   DB::beginTransaction();

                    //debit source account
                   $source_account->decrement('balance', $amount);

                   $converted_amount = $amount * $rate;

                   //credit receiving account
                   $receiving_account->increment('balance', $converted_amount);

                   $sender->sent()->create([
                           'source_currency_id'=>$source_currency,
                           'target_currency_id'=>$target_currency,
                           'target_user_id'=>$receiver->id,
                           'rate'=>$rate,
                           'amount_transferred'=>$amount,
                           'amount_received'=>$converted_amount,
                       ]);

                   DB::commit();

                   return redirect()->route('transactions.index')->with('success','Transaction successful !!');
               }catch (\Exception $ex)
               {
                   throw $ex;
                   return redirect()->back()->withInput()->withErrors('Transaction failed !!!');
               }


            //send mail for successful transaction
        }


        $data = (object)[
            'users'    => User::query()->where('id','!=',auth()->user()->id)->get(),
            'accounts' => auth()->user()->account,
            'currencies' => Currency::query()->get()
        ];

        return view('transaction.create',compact('data'));
    }


    public function checkAccounts($amount,$source_account)
    {

        if($amount > $source_account->balance)
        {
            return false;
        }
        return  true;
    }


    private  function mail_send($body, $head,$subject,$to,$from)
    {
        Notification::route('mail', $to)->notify(new Alertify($body, $head, $subject, $from));
    }


}
