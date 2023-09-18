<?php

namespace App\Http\Controllers;

use App\Models\AppSettings;
use App\Http\Requests\StoreAppSettingsRequest;
use App\Http\Requests\UpdateAppSettingsRequest;
use Illuminate\Http\Request;
class AppSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AppSettings::all();
    }



}
