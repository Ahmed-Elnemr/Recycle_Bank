<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\OrdersDetails;
use App\Models\PersonalInformation;
use App\Http\Controllers\Controller;

class ShowOrderDetailsController extends Controller
{
    public function show($order_details)
    {
        ##############customer  
        $order = Orders::find($order_details);
        $userId = $order->user_id;
        $customerInfo = PersonalInformation::where('user_id', $userId)->first();
        
        ##############delevery  
        $deliveryId = $order->delivery_id;
        $deliveryInfo = PersonalInformation::where('user_id', $deliveryId)->first();
        ////////// order details
       $orderDetails= OrdersDetails::where('order_id',$order_details)->get();
    //    dd($orderDetails);
    

        $details = OrdersDetails::find($order_details);

        return view('admin.order_details', compact('order','deliveryInfo','details', 'customerInfo', 'orderDetails'));
    }

}