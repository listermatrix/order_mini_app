<?php

namespace App\Http\Controllers\Order;


use App\Models\Order;
use App\Providers\OrderLogEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index(Request $request)
    {
            $orders  = Order::query();
            $department = auth()->user()->department_id ?? 0;

            if($department == 1)
                $orders->whereIn('status',['ORDER_RECEIVED','ORDER_PROCESSING'])->latest();
            else if($department == 2)
                $orders->where('status','ORDER_READY_TO_SHIP')->latest();
            else
                $orders =  $orders->latest();


            return view('order.index',[
                'orders' => $orders->get()
            ]);
    }

    public function create(Request $request)
    {

          $validator = Validator::make($request->all(),
          [
              'date' =>'required',
              'amount' =>'required',
              'items' =>'required',
          ]);


            if($validator->fails())
                return $this->errorResponse($validator->errors()->all());


            $data  = $request->all();
            $data['order_no'] = uniqid('OR');
            $data['status'] = 'ORDER_RECEIVED';


            DB::beginTransaction();

             $order  = Order::query()->create($data);
             OrderLogEvent::dispatch($order);

            DB::commit();


          return  $this->successResponse($order,'ORDER_RECEIVED');
    }

    public function edit(Request $request,Order $order)
    {

        if($request->isMethod('post'))
        {
            //validate input request
            $request->validate([
                'picking_product' => 'required',
                'shipping_label' => 'required_if:status,ORDER_READY_TO_SHIP',
                'shipping_company' => 'required_if:status,ORDER_READY_TO_SHIP',
                'shipping_tracking_number' => 'required_if:status,ORDER_READY_TO_SHIP',
            ]);




            $data = $request->all(); //retrieve all submitted data as request

            if($order->status == 'ORDER_RECEIVED' && $data['picking_product'] == "Yes"){

                $data['status'] = 'ORDER_PROCESSING';

            }
            else if($order->status == 'ORDER_PROCESSING'){

                //generate box id and set status to ready to ship
                $data['box_id'] = $data['box_id'] ?? uniqid('BX',FALSE);
                $data['status'] = 'ORDER_READY_TO_SHIP';

            }
            else if($order->status == 'ORDER_READY_TO_SHIP'){

                $data['status'] = 'ORDER_SHIPPED';

                //file upload if file was upload by user & save to labels directory
                if($request->hasFile('shipping_label')){
                    $request->file('shipping_label')->storePubliclyAs('public/labels',$request->file('shipping_label')->getClientOriginalName());
                    $data['shipping_label'] = 'storage/labels/'.$request->file('shipping_label')->getClientOriginalName();
                }

            }


            //transaction initiation
            DB::beginTransaction();

                $order->update($data);
                //event dispatch
                OrderLogEvent::dispatch($order);

            DB::commit();


            return redirect()->route('order.index')->with('success','Order Successfully Updated');

        }


        return view('order.edit',[
            'order' => $order
        ]);
    }




    public function log(Order $order)
    {
        return view('order.log',[
            'order' =>$order
        ]);
    }


    public function cancel(Request $request,$order_id)
    {

        $order = Order::query()->find($order_id);

        if(empty($order)) //return error response
            return $this->errorResponse("Order not found");


        //set status
        $data['status'] = 'ORDER_CANCELLED';

        DB::beginTransaction();

        $order->update($data); //model update

        //event dispatch
        OrderLogEvent::dispatch($order);

        DB::commit();

        //return response
        return  $this->successResponse($order,'ORDER_CANCELLED');
    }



    public function successResponse($data,$msg = null)
    {
        return response()->json(['code'=>200,'data'=>$data ,'message'=>$msg]);
    }

    public function errorResponse($data)
    {
        return response()->json(['code'=>400,'message'=>$data]);

    }





}
