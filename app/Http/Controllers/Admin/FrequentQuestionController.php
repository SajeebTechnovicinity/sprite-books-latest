<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrequentQuestion;
use Illuminate\Http\Request;

class FrequentQuestionController extends Controller
{
    public function index()
    {
        // if(Auth::user()->can('view-author')) {
            $data['list'] = FrequentQuestion::orderBy('id','desc')->get();
            return view("backend.pages.frequent_question.index", $data);
        // }
    }

    public function store(Request $request){
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);
        $data = $request->except('_token');
        FrequentQuestion::create($data);
    }
}
