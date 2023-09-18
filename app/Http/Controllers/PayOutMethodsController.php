<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PayOutMethods;
use App\Models\User;
use App\Http\Requests\StorePayOutMethodsRequest;
use App\Http\Requests\UpdatePayOutMethodsRequest;


class PayOutMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(\Auth::id());
        return PayOutMethods::where('user_id' ,  $authUser->id )->paginate(25);
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
        $PayOutMethods = new PayOutMethods();
        $PayOutMethods->user_id = $authUser->id;
        $PayOutMethods->payment_method = "";
        $PayOutMethods->payment_type = "phone-wallwt";
        $PayOutMethods->value = $request->value;
        $PayOutMethods->save();
        return $PayOutMethods;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PayOutMethods  $payOutMethods
     * @return \Illuminate\Http\Response
     */
    public function show(PayOutMethods $payOutMethods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PayOutMethods  $payOutMethods
     * @return \Illuminate\Http\Response
     */
    public function edit(PayOutMethods $payOutMethods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayOutMethodsRequest  $request
     * @param  \App\Models\PayOutMethods  $payOutMethods
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayOutMethodsRequest $request, PayOutMethods $payOutMethods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PayOutMethods  $payOutMethods
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayOutMethods $payOutMethods)
    {
        //
    }
}
