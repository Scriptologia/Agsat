<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function tokenAbilities (Request $request) {
        $abilities = auth()->user()->role->permissions->pluck('slug')->toArray();
        $token = $request->user()->createToken('abilities',$abilities)->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
