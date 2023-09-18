<?php

namespace App\Http\Controllers;

use App\Models\WalletTransactions;
use App\Models\User;
use App\Http\Requests\StoreWalletTransactionsRequest;
use App\Http\Requests\UpdateWalletTransactionsRequest;
use Illuminate\Http\Request;
class WalletTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(\Auth::id());
        return WalletTransactions::where('user_id' ,  $authUser->id )->orderBy('id' , 'DESC')->paginate(15);
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
     * @param  \App\Http\Requests\StoreWalletTransactionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWalletTransactionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WalletTransactions  $walletTransactions
     * @return \Illuminate\Http\Response
     */
    public function show(WalletTransactions $walletTransactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WalletTransactions  $walletTransactions
     * @return \Illuminate\Http\Response
     */
    public function edit(WalletTransactions $walletTransactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWalletTransactionsRequest  $request
     * @param  \App\Models\WalletTransactions  $walletTransactions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWalletTransactionsRequest $request, WalletTransactions $walletTransactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WalletTransactions  $walletTransactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalletTransactions $walletTransactions)
    {
        //
    }
}
