<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\categories;
use App\Http\Requests\StoreItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use Illuminate\Http\Request;
class ItemsController extends Controller
{



    public function index(Request $request)
    {

        if($request->type != null)
        {
            switch($request->type)
            {
                case "bycat":


                    if($request->category_id == 0 || $request->category_id == null ){
                        $categories = categories::first();
                        $r = Items::where('category_id' , $categories->id )->with('category')->with('media')->paginate(25);
                    }else{
                        $r = Items::where('category_id' , $request->category_id )->with('category')->with('media')->paginate(25);
                    }

                    return $r;
                  break;

                  case "byterm":



                        $r = Items::where('name_ar' ,'like', "%".$request->term."%")
                        ->orWhere('name_en' ,'like', "%".$request->term."%" )
                        ->with('category')->with('media')->paginate(25);


                    return $r;
                  break;

                 default:

                    break;
            }

        }else
        {

        }

    }

    public function show($items)
    {
        return Items::with('media')->with('category')->findOrFail($items);

    }



}
