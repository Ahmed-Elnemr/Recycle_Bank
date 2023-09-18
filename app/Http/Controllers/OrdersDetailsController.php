<?php

namespace App\Http\Controllers;

use App\Models\OrdersDetails;
use App\Models\User;
use App\Http\Requests\StoreOrdersDetailsRequest;
use App\Http\Requests\UpdateOrdersDetailsRequest;
use Illuminate\Http\Request;

class OrdersDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());

        if($authUser != null){
        $tracks = $request->json()->all();
        foreach ($tracks as $track) {
            //$track->user_id = $authUser->id;
            OrdersDetails::create($track);
        }
        return $tracks;
        }else{

        }

    }


    public function show( $id)
    {
        //
        $authUser = User::find(\Auth::id());

        if($authUser != null)
        {
            return OrdersDetails::where('order_id' , $id)
            ->with('item')
            ->get();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdersDetails $ordersDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdersDetailsRequest  $request
     * @param  \App\Models\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersDetailsRequest $request, OrdersDetails $ordersDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdersDetails $ordersDetails)
    {
        //
    }
}
