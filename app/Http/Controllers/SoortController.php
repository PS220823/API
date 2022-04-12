<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soort;

class SoortController extends Controller
{
    //Alle soorten restaurants
    public function index()
    {
        return Soort::All(); 
    }


    //Specifiek soort restaurant
    public function show(Soort $id)
    {
        return $id;
    }
}
