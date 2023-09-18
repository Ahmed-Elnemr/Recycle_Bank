<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrdersDetails;
use App\Models\User;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use Illuminate\Http\Request;
class OrdersController extends Controller
{

    public function index()
    {

        $authUser = User::find(\Auth::id());

        if($authUser != null){




            if($authUser->role_id == 3 || $authUser->role_id == null)
            {
                return Orders::Where('customer_id' ,$authUser->id )
                 ->with('address')
                 ->with('delivery')
                 ->with('details')->orderBy('id', 'DESC')->paginate(25);
            }else{
                return Orders::Where('delivery_id' ,$authUser->id )
                ->Where('status' , 'approved')
                ->with('address')
                ->with('customer')
                ->with('peronalinfo')
                ->with('details')->orderBy('id', 'DESC')->paginate(100);
            }





        }




    }


    public function create()
    {

    }


    public function store(Request $request)
    {
            $authUser = User::find(\Auth::id());
            if($authUser != null)
            {
                    $orders = new Orders();
                    $orders->customer_id = $authUser->id ;
                  //  $orders->delivery_id = 0 ;
                    $orders->note = $request->note;
                    $orders->total = $request->total;

                    $orders->address_id = $request->addresse_id;
                    $orders->status =  "pending";

                    $orders->save();
                    return $orders;
            }



    }


    public function show(Orders $orders)
    {

    }


    public function edit(Orders $orders)
    {

    }


    public function update(Request $request)
    {
        $authUser = User::find(\Auth::id());

        if($authUser->role_id == 2 || $authUser->role_id == null)
        {

            if($request->status == "ping")
            {
                Orders::ping($request->id);
            }else{
                  Orders::updateOrderStatus($request->id , $request->status);
                if($request->status == "completed")
                {
                    Orders::updateWallet($request->id);
                }
            }


        }
    }


    public function destroy($id)
    {
        $authUser = User::find(\Auth::id());
        $not =  Orders::findOrFail($id);

        if($authUser->id  == $not->customer_id)
        {
            return Orders::destroy($id);
        }
    }
}
