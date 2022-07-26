<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ZipcodeResource;
use App\Models\Zipcode;
use Illuminate\Http\Request;

class ZipcodeController extends Controller
{
    public function index($zipcode_id) 
    {
        $zipcode = Zipcode::whereZipCode($zipcode_id)
            ->with('settlements')
            ->first();

        return new ZipcodeResource($zipcode);
    }
}
