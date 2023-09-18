<?php

namespace App\Http\Controllers;

use App\Models\PayOutRequest;
use App\Models\User;
use App\Http\Requests\StorePayOutRequestRequest;
use App\Http\Requests\UpdatePayOutRequestRequest;
use Illuminate\Http\Request;
class PayOutRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(\Auth::id());
        return PayOutRequest::where('user_id' ,  $authUser->id )->paginate(15);
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
        $PayOutRequest = new PayOutRequest();
        $PayOutRequest->user_id = $authUser->id;
        $PayOutRequest->amount = $request->amount;
        $PayOutRequest->reason =  "pending";
        $PayOutRequest->pay_out_methods_id = $request->pay_out_methods_id;
        $PayOutRequest->save();
        return $PayOutRequest;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PayOutRequest  $payOutRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PayOutRequest $payOutRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PayOutRequest  $payOutRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PayOutRequest $payOutRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayOutRequestRequest  $request
     * @param  \App\Models\PayOutRequest  $payOutRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayOutRequestRequest $request, PayOutRequest $payOutRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PayOutRequest  $payOutRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayOutRequest $payOutRequest)
    {
        //
    }
}
