<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookDocuments;
use App\Models\Settings\Genere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
 
    public function view_book($id){

        if(!session('author_id')){
    
            return redirect('/user/login');
        }

        $book = Book::find($id);
        
        if($book){
            $data['book'] = $book;
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
            $data['generes'] = Genere::all();
            $data['author_books'] = Book::where('id', '!=', $book->id)->whereAuthorId($book->author_id)->get();
            return view('frontend.pages.book.index',$data);
        }
    }
    public function edit_book($id){
        $book = Book::find($id);
        
        if($book){
            $data['book'] = $book;
            $data['author_created_list'] = Author::all();
            $data['generes'] = Genere::all();
            $data['author_books'] = Book::where('id', '!=', $book->id)->whereAuthorId($book->author_id)->get();
            return view('frontend.pages.book.edit',$data);
        }
    }
    public function search_book(Request $request){

        $name = $request->input('name');

        // Use Eloquent to query books based on the 'book_name'
        $data['books'] = Book::where('book_name', 'like', "%$name%")->get();
        $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
        $data['generes'] = Genere::all();

        // Return the result in the response
        //return response()->json(['books' => $data]);
        return view('frontend.pages.book.search',$data);
    }
    public function delete_book_doccunment($id)
    {
        $bookDocument = BookDocuments::find($id);

        if ($bookDocument) {
            $pathToDelete = $bookDocument->path;
            if (file_exists($pathToDelete)) {
                File::delete($pathToDelete);
            }
        }
        BookDocuments::where('id',$id)->delete();
        Session::flash('success','Doccument deleted successfully');
        return back();
    }
}
