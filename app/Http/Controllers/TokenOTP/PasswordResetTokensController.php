<?php

namespace App\Http\Controllers\TokenOTP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordResetTokensController extends Controller
{
    public function store(Request $request){
        return response()->json(['status' => 'resetTokenPassword'.$request->email]);
    }
}
