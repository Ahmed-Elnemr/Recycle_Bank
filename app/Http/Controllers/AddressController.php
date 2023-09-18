<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Http\Request;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //it's will return currunt user address
        $authUser = User::find(\Auth::id());

        return Address::where('user_id' ,  $authUser->id )->paginate(15);

    }



    public function store(Request $request)
    {

            $authUser = User::find(\Auth::id());
            if($authUser != null)
            {

                $Address = new Address();
                $Address->city  = $request->city;
                $Address->country = $request->country;
                $Address->street = $request->street;
                $Address->postal_code = $request->postal_code;
                $Address->user_id = $authUser->id ;
                $Address->save();
                return $Address;
            }


    }







    public function update(UpdateAddressRequest $request, Address $address)
    {
      
    }

    public function destroy($id)
    {
        $authUser = User::find(\Auth::id());
        $not =  Address::findOrFail($id);

        if($authUser->id  == $not->user_id)
        {
            return Address::destroy($id);
        }
    }
}
