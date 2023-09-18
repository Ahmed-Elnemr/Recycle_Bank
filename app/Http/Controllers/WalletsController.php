<?php

namespace App\Http\Controllers;

use App\Models\Wallets;
use App\Models\User;


use App\Http\Requests\StoreWalletsRequest;
use App\Http\Requests\UpdateWalletsRequest;
use Illuminate\Http\Request;
class WalletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(\Auth::id());
        return Wallets::where('user_id' ,  $authUser->id )->first();
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
     * @param  \App\Http\Requests\StoreWalletsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWalletsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallets  $wallets
     * @return \Illuminate\Http\Response
     */
    public function show(Wallets $wallets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallets  $wallets
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallets $wallets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWalletsRequest  $request
     * @param  \App\Models\Wallets  $wallets
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWalletsRequest $request, Wallets $wallets)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallets  $wallets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallets $wallets)
    {
        //
    }
}
