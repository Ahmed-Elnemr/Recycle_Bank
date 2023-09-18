<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;
use Illuminate\Http\Request;
class CategoriesController extends Controller
{

    public function index()
    {

        $categories = categories::with('media')->get();
        return $categories;

    }



    public function show($categories)
    {
        return categories::with('media')->findOrFail($categories);
    }



}
