<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use App\Models\User;

use App\Http\Requests\StorePersonalInformationRequest;
use App\Http\Requests\UpdatePersonalInformationRequest;
use Illuminate\Http\Request;
class PersonalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(\Auth::id());
        return PersonalInformation::where('user_id' ,  $authUser->id )->first();
    }


    public function store(Request $request)
    {

        $authUser = User::find(\Auth::id());

        if($authUser != null)
            {

                $old  = PersonalInformation::where('user_id' ,  $authUser->id )->first();

                if($old == null) {
                    $personalInformation = new PersonalInformation();
                    $personalInformation->user_id = $authUser->id ;

                    $personalInformation->first_name = $request->first_name ;
                    $personalInformation->last_name = $request->last_name ;
                    $personalInformation->personal_id = $request->personal_id ;
                    $personalInformation->idendety_type = $request->idendety_type ;
                    $personalInformation->gender = $request->gender ;
                    $personalInformation->birthdate = $request->birthdate ;
                    $personalInformation->phone_number = $request->phone_number;
                    $personalInformation->nationality =$request->nationality;
                    $personalInformation->save();
                    return $personalInformation;
                }else{


                    $personalInformation =   $old;
                    $personalInformation->id = $old->id;

                    $personalInformation->user_id = $authUser->id ;

                    $personalInformation->first_name = $request->first_name ;
                    $personalInformation->last_name = $request->last_name ;
                    $personalInformation->personal_id = $request->personal_id ;
                    $personalInformation->idendety_type = $request->idendety_type ;
                    $personalInformation->gender = $request->gender ;
                    $personalInformation->birthdate = $request->birthdate ;
                    $personalInformation->phone_number = $request->phone_number;
                    $personalInformation->nationality =$request->nationality;
                    $personalInformation->update();
                    return $personalInformation;
                }


            }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonalInformation  $personalInformation
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalInformation $personalInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalInformation  $personalInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalInformation $personalInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonalInformationRequest  $request
     * @param  \App\Models\PersonalInformation  $personalInformation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonalInformationRequest $request, PersonalInformation $personalInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonalInformation  $personalInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalInformation $personalInformation)
    {
        //
    }
}
