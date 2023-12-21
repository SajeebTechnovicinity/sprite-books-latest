<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Library;
use App\Models\Settings\Genere;
use App\Models\SuggestedBook;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(){
        $data['books'] = Book::whereAuthorId(session('author_id'))->get();
        $data['suggested_books'] = SuggestedBook::all();
        $data['generes'] = Genere::all();
        $data['type']=3;
        return view('frontend.pages.author.library.index',$data);
     }
     public function recent(){
        $data['books'] = Book::whereAuthorId(session('author_id'))->orderBy('id','desc')->get();
        $data['suggested_books'] = SuggestedBook::orderBy('id','desc')->get();
        $data['generes'] = Genere::all();
        $data['type']=2;
        return view('frontend.pages.author.library.index',$data);
     }
     public function popular(){
        $data['books'] = Book::whereAuthorId(session('author_id'))->get();
        $data['suggested_books'] = SuggestedBook::orderBy('id','desc')->get();
        $data['generes'] = Genere::all();
        $data['type']=1;
        return view('frontend.pages.author.library.index',$data);
     }
     public function create_community(Request $request){

        $request->validate([
            'community_name' => 'required'
        ]);

        $community = new Community;
        $community->community_name = $request->community_name;
        $community->author_id = session('author_id');
        $community->community_description = $request->community_description;

        if($request->file_updoad){


            if (isset($request->file_updoad)) {
                $file = $request->file('file_updoad');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $community->community_cover_image = $data['path'];
            }
            $community->save();
        }

        $community->save();



        return redirect()->back()->with('msg','Community added successfully.');
     }
}
