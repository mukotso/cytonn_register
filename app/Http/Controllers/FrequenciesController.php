<?php

namespace App\Http\Controllers;



use App\Models\Frequency;

class FrequenciesController extends Controller
{
    public function index(){
        return Frequency::all();
    }
}
