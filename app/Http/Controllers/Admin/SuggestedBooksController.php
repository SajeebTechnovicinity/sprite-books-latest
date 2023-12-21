<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Settings\Genere;
use App\Models\SuggestedBook;
use Illuminate\Http\Request;

class SuggestedBooksController extends Controller
{
    public function index()
    {
        // if(Auth::user()->can('view-author')) {
            $data['list'] = SuggestedBook::orderBy('id','desc')->get();
            $data['books'] = Book::orderBy('id','desc')->get();
            $data['authors'] = Author::whereType('AUTHOR')->get();
            return view("backend.pages.suggested_book.index", $data);
        // }
    }

    public function store(Request $request){
        $request->validate([
            'book_id' => 'required'
        ]);
        $book = Book::find($request->book_id);
        $data = $request->except('_token');
        $data['author_id'] = $request->author_id;
        SuggestedBook::create($data);
    }

    public function get_author_generes_by_author_id(Request $request){
        $data = Book::whereAuthorId($request->id)->get();
        // print_r($data);
        $output = ' <option value="">Select</option>';
        foreach($data as $row){
            $genere = Genere::find($row->genere_id);
            $output .= ' <option value="'.$genere->id.'">'.$genere->genere_name.'</option>';
        }
        return $output;
    }

    public function get_author_books_by_genere_id(Request $request){
        $data = Book::whereAuthorId($request->author_id)->whereGenereId($request->id)->get();
        $output = ' <option value="">Select</option>';
        foreach($data as $row){
            $output .= ' <option value="'.$row->id.'">'.$row->book_name.'</option>';
        }
        return $output;
    }
}
