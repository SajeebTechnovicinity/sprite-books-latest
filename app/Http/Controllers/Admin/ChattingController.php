<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChattingController extends Controller
{
    function chat(){
        $adminId=Auth::user()->id;

        $tokenList= ChatToken::get();

        return view('backend.pages.chat.chat')->with(compact('tokenList','adminId'));


    }
}
