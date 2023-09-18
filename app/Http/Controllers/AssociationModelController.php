<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\AssociationModel;
use App\Http\Requests\StoreAssociationModelRequest;
use App\Http\Requests\UpdateAssociationModelRequest;
use Illuminate\Http\Request;
class AssociationModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(\Auth::id());

        return AssociationModel::where('user_id' ,  $authUser->id )->paginate(25);

    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());

        $associationModel = new AssociationModel();

        $associationModel->user_id = $authUser->id;

        if($request->value != null )
        {
            if($request->value == 500 || $request->value == 1000 || $request->value == 2000 || $request->value == 3000 || $request->value == 4000){
                $associationModel->value = $request->value;
            }else{
                $associationModel->value = 500;
            }

        }else{
            $associationModel->value = 500;
        }
       $mytotal = AssociationModel::where('user_id' ,  $authUser->id )->where('suspended' , false)->where('finished' , true)->count();
       $unfinished = AssociationModel::where('user_id' ,  $authUser->id )->where('finished' , false)->count();

       switch($mytotal)
       {
        case 0 :
            $associationModel->user_order = 10;
        break;

        case 1 :
            $associationModel->user_order = 9;
        break;

        case 2 :
            $associationModel->user_order = 8;
        break;

        case 3 :
            $associationModel->user_order = 7;
            break;

        case 4 :
            $associationModel->user_order = 6;
            break;

        case 5 :
            $associationModel->user_order = 5;
            break;

         case 6 :
            $associationModel->user_order = 4;
                break;
         case 7 :
            $associationModel->user_order = 3;
            break;

         case 8 :
            $associationModel->user_order = 2;
                break;
        case 9 :
        case 10 :
        default:
            $associationModel->user_order = 1;


          break;


       }





        if($unfinished == 0)
        {
              $associationModel->save();
        }




       return $associationModel;










    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssociationModel  $associationModel
     * @return \Illuminate\Http\Response
     */
    public function show(AssociationModel $associationModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssociationModel  $associationModel
     * @return \Illuminate\Http\Response
     */
    public function edit(AssociationModel $associationModel)
    {
        //
    }


    public function update(Request $request, AssociationModel $associationModel)
    {
        //
    }


}
