<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookDocuments;
use App\Models\BookView;
use App\Models\Settings\Genere;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{

    public function view_book($id)
    {

        // if (!session('author_id')) {

        //     return redirect('/user/login');
        // }

        $today = Carbon::now();

        if (session('author_id') != null) {
            BookView::create([
                'book_id' => $id,
                'user_id' => session('author_id')
            ]);
        }



        $book = Book::find($id);

        $book->viewers = $book->viewers + 1;

        $book->view_date_time = $today;

        $book->save();

        if ($book) {
            $data['book'] = $book;
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
            $data['generes'] = Genere::all();
            $data['author_books'] = Book::where('id', '!=', $book->id)->whereAuthorId($book->author_id)->get();
            return view('frontend.pages.book.index', $data);
        }
    }
    public function view_book_with_name($id,$name)
    {

        // if (!session('author_id')) {

        //     return redirect('/user/login');
        // }

        $today = Carbon::now();

        if (session('author_id') != null) {
            BookView::create([
                'book_id' => $id,
                'user_id' => session('author_id')
            ]);
        }



        $book = Book::find($id);

        $book->viewers = $book->viewers + 1;

        $book->view_date_time = $today;

        $book->save();

        if ($book) {
            $data['book'] = $book;
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
            $data['generes'] = Genere::all();
            $data['author_books'] = Book::where('id', '!=', $book->id)->whereAuthorId($book->author_id)->get();
            return view('frontend.pages.book.index', $data);
        }
    }
    public function edit_book($id)
    {
        $book = Book::find($id);

        if ($book) {
            $data['book'] = $book;
            $data['author_created_list'] = Author::all();
            $data['generes'] = Genere::all();
            $data['author_books'] = Book::where('id', '!=', $book->id)->whereAuthorId($book->author_id)->get();
            return view('frontend.pages.book.edit', $data);
        }
    }
    public function search_book(Request $request)
    {

        $name = $request->input('name');

        // Use Eloquent to query books based on the 'book_name'
        $data['books'] = Book::with('bookAuthor')
        ->where('is_delete', 0)
        ->where(function ($query) use ($name) {
            $query->where('book_name', 'like', "%$name%")
                ->orWhere('meta_key', 'like', "%$name%") // Search in meta_key
                ->orWhereHas('bookAuthor', function ($query) use ($name) {
                    $query->where('author_name', 'like', "%$name%")
                        ->orWhere('author_last_name', 'like', "%$name%");
                })
                ->orWhereHas('Genere', function ($query) use ($name) {
                    $query->where('genere_name', 'like', "%$name%");
                });
        })
        ->orderBy('id','desc')->get();

        $data['authors'] = Author::where('author_status', 1)
        ->where('type', 'AUTHOR')
        ->where(function($query) use ($name) {
            $query->where('author_name', 'like', "%$name%")
                  ->orWhere('author_last_name', 'like', "%$name%");
        })
        ->orderBy('id', 'desc')
        ->get();
        $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
        $data['generes'] = Genere::all();

        // Return the result in the response
        //return response()->json(['books' => $data]);
        if (session('author_id') == null) {
            return view('frontend.pages.book.search-guest', $data);
        } else {
            return view('frontend.pages.book.search', $data);
        }
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
        BookDocuments::where('id', $id)->delete();
        Session::flash('success', 'Doccument deleted successfully');
        return back();
    }
    public function delete($id)
    {
        Book::where('id', $id)->update([
            'is_delete' => 1
        ]);

        return redirect()->back()->with('success', 'Book delete successfully');
    }
}
