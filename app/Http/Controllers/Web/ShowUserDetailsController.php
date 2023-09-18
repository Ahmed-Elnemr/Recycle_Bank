<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Http\Controllers\Controller;

class ShowUserDetailsController extends Controller
{
    public function show($id)
    {
        $userInfo = PersonalInformation::where('user_id', $id)->first();
        //addres
        $userAddresses = Address::where('user_id', $id)->first();
        //all adressees
        $adressees=Address::where('user_id', $id)->get();
        //
        return view('admin.user_details', compact( 'userInfo','userAddresses','adressees'));
    }
    public function details($id)
    {

        $id;
        return view('admin.user-details-livewire', compact( 'id'));
    }
}
