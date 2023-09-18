<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\OrdersStatus;
use App\Http\Requests\StoreOrdersStatusRequest;
use App\Http\Requests\UpdateOrdersStatusRequest;

class OrdersStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrdersStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrdersStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdersStatus  $ordersStatus
     * @return \Illuminate\Http\Response
     */
    public function show(OrdersStatus $ordersStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdersStatus  $ordersStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdersStatus $ordersStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdersStatusRequest  $request
     * @param  \App\Models\OrdersStatus  $ordersStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersStatusRequest $request, OrdersStatus $ordersStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdersStatus  $ordersStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdersStatus $ordersStatus)
    {
        //
    }
}
