<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // if(Auth::user()->can('view-author')) {
            $data['list'] = Book::orderBy('id','desc')->get();
            return view("backend.pages.book.index", $data);
        // }
    }
}
