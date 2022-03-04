<?php

namespace App\Http\Controllers\TRANS;


use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\TransSuccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

                   $receiving_users = $data['receiving_user'];
                   $total = count($receiving_users);

                   if(!$this->checkAccounts(($amount * $total),$source_account))
                       return redirect()->back()->withInput()->withErrors('Insufficient balance !!!');


                   $target_currency = (int)$data['target_currency'];


                   //get exchange rate
                   $direct = ExchangeRate::query()->where('source_currency', $source_currency)
                       ->where('target_currency', $target_currency)->first();

                   $rate = 1;



                   if ($source_currency !== $target_currency) {


                       if ($direct) {
                           $rate = $direct->rate;
                       } else {
                           $reverse = ExchangeRate::query()->where('source_currency', $target_currency)
                               ->where('target_currency', $source_currency)->first();

                           if (!$reverse)
                               return redirect()->back()->withInput()->withErrors('Required Exchange rate is not configured !!!');

                           $rate = $reverse->inverse;
                       }

                   }

                   DB::beginTransaction();

                    foreach ($receiving_users as $user) {
                        /** receiver information, receiver account type , target currency **/
                        $receiver = User::query()->find($user);
                        $receiving_account = $receiver->account()->where('currency_id', $target_currency)->first();




                        //debit source account
                        $source_account->decrement('balance', $amount);

                        $converted_amount = $amount * $rate;

                        //credit receiving account
                        $receiving_account->increment('balance', $converted_amount);

                        $trans = $sender->sent()->create([
                            'source_currency_id' => $source_currency,
                            'target_currency_id' => $target_currency,
                            'target_user_id' => $receiver->id,
                            'rate' => $rate,
                            'status' => 'success',
                            'amount_transferred' => $amount,
                            'amount_received' => $converted_amount,
                        ]);




                        //recipient notification
                        Notification::route('mail', $receiver->email)
                            ->notify(new TransSuccess($trans));



                    }

                   DB::commit();

                   return redirect()->route('transactions.index')->with('success','Transaction successful !!');
               }catch (\Exception $ex)
               {
                   return redirect()->back()->withInput()->withErrors('Transaction failed !!!');
               }

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



}
