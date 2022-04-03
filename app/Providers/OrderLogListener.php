<?php

namespace App\Providers;

use App\Providers\OrderLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\OrderLogEvent  $event
     * @return void
     */
    public function handle(OrderLogEvent $event)
    {
        $username  = auth()->user()->username ?? null;
        $user_id = auth()->user()->id ?? null;
        $status  = $event->order->status;
        $order = $event->order;
        $label = " <a class='btn btn-sm btn-primary' href=".asset($order->shipping_label).">VIEW LABEL</a>";
        if($status == 'ORDER_RECEIVED')
            $message  = "has been received by the system ";

        else if($status == 'ORDER_PROCESSING')
            $message  = "has been changed to processing  by $username ($user_id)";

        else if($status == 'ORDER_READY_TO_SHIP')
            $message  = "has been changed to READY TO SHIP  by $username ($user_id) with BOX_ID :{$order->box_id}";

        else if($status == 'ORDER_SHIPPED')
            $message  = "has been changed to SHIPPED by $username ($user_id) with AWB : {$order->shipping_tracking_number} by {$order->shipping_company}  $label";

        else if($status == 'ORDER_CANCELLED')
            $message  = "has been CANCELLED by $username ($user_id)";
        else
            $message = null;


        $event->order   ->log("Order #{$order->order_no} $message ");

    }
}
