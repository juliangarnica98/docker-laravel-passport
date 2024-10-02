<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user():JsonResponse
    {
        $data = User::all();
        return response()->json(['data' => $data],200);
    }
}
