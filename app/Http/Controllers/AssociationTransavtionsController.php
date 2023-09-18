<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\AssociationTransavtions;
use App\Http\Requests\StoreAssociationTransavtionsRequest;
use App\Http\Requests\UpdateAssociationTransavtionsRequest;
use Illuminate\Http\Request;
class AssociationTransavtionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $authUser = User::find(\Auth::id());

        return AssociationTransavtions::where('user_id' ,  $authUser->id )
        ->where('association_models_id' ,$id)->get();

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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssociationTransavtions  $associationTransavtions
     * @return \Illuminate\Http\Response
     */
    public function show(AssociationTransavtions $associationTransavtions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssociationTransavtions  $associationTransavtions
     * @return \Illuminate\Http\Response
     */
    public function edit(AssociationTransavtions $associationTransavtions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssociationTransavtionsRequest  $request
     * @param  \App\Models\AssociationTransavtions  $associationTransavtions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssociationTransavtionsRequest $request, AssociationTransavtions $associationTransavtions)
    {
        //
    }


}
