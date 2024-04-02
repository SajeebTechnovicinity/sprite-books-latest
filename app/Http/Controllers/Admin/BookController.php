<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookDocuments;
use App\Models\Settings\Genere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function index()
    {
        // if(Auth::user()->can('view-author')) {
            $data['list'] = Book::where('is_delete',0)->orderBy('id','desc')->get();
            return view("backend.pages.book.index", $data);
        // }
    }
    public function edit($id)
    {
        // if(Auth::user()->can('view-author')) {
            $book = Book::where('id',$id)->first();
            $authors=Author::where('is_delete',0)->where('type','AUTHOR')->get();
            $generes=Genere::all();
            $publishers=Author::where('is_delete',0)->where('type','PUBLISHER')->get();
            return view("backend.pages.book.edit", compact('book','authors','generes','publishers'));
        // }
    }
    public function create()
    {
        // if(Auth::user()->can('view-author')) {
   
            $authors=Author::where('is_delete',0)->where('type','AUTHOR')->get();
            $generes=Genere::all();
            $publishers=Author::where('is_delete',0)->where('type','PUBLISHER')->get();
            return view("backend.pages.book.create", compact('authors','generes','publishers'));
        // }
    }

    public function store(Request $request)
    {

        if (!$request->isbn) {
            Session::flash('wrong', 'Isbn is required');
            return back();
        }

        $isbn = $request->isbn; // Replace with the ISBN you want to query
        $apiUrl = "https://api2.isbndb.com/book/{$isbn}";

        $response = Http::withHeaders([
            'Authorization' => env('ISBN_API_KEY'),
            'User-Agent' => 'insomnia/5.12.4',
            'Accept' => '*/*',
        ])->get($apiUrl);

        if ($response->successful()) {
            // Request was successful, process the response
            $bookData = $response->json();
            //dd($bookData);
        } elseif ($response->status() == 404) {
            // Not Found error
            //dd("Error: Not Found");
            Session::flash('wrong', 'Invalid ISBN');
            return back();
        } elseif ($response->status() == 429) {
            // Too Many Requests error
            //dd("Error: Limit Exceeded");
            Session::flash('wrong', 'ISBN Limit Exceeded');
            return back();
        } else {
            // Handle other status codes
            //dd("Error: Unexpected status code {$response->status()}");
            Session::flash('wrong', "Unexpected status code {$response->status()}");
            return back();
        }
        // $validator = Validator::make($request->all(), [
        //     'file_updoad' => 'nullable|mimes:png,jpg',
        // ], [
        //     'file_updoad.mimes' => 'File must be png,jpg',
        // ]);
        // $validator = Validator::make($request->all(), [
        //     'video_file_updoad' => 'nullable|mimes:mp4',
        // ], [
        //     'video_file_updoad.mimes' => 'Video file must be mp4',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withWrong($validator)->withInput();
        //     // You can customize the redirect URL if needed, and withInput() retains the user's input.
        // }

        if (!$request->book_name) {
            Session::flash('wrong', 'Book Name is required');
            return back();
        }
        // if(!$request->author_define)
        // {
        //     Session::flash('wrong','Role is required');
        //     return back();
        // }
        if (!$request->book_price) {
            Session::flash('wrong', 'Main Book Price is required');
            return back();
        }
        // if (!$request->ebook_price) {
        //     Session::flash('wrong', 'Ebook Price is required');
        //     return back();
        // }
        // if (!$request->file_updoad) {
        //     Session::flash('wrong', 'Image File is required');
        //     return back();
        // }
        // if (!$request->video_file_updoad) {
        //     Session::flash('wrong', 'Video File is required');
        //     return back();
        // }

        // $file=$request->file_updoad;
        // // Check the file size
        // $maxFileSize = 512; // Maximum file size in kilobytes (1 MB)
        // $fileSize = $file->getSize();

        // if ($fileSize > $maxFileSize * 1024) {
        //     Session::flash('wrong', 'Maximum image file size 512kb');
        //     return back();
        // }

        // if ($request->video_file_updoad) {

        //     $file=$request->video_file_updoad;
        //     // Check the file size
        //     $maxFileSize = 5160; // Maximum file size in kilobytes (5 MB)
        //     $fileSize = $file->getSize();

        //     if ($fileSize > $maxFileSize * 1024) {
        //         Session::flash('wrong', 'Maximum video file size 5MB');
        //         return back();
        //     }

        // }
        // echo '<pre>';print_r($request->all());die;
        $book = new Book;
        $book->book_name = $request->book_name;
        if ($request->book_author) {
            $book->author_id = $request->book_author;
            $book->publisher_id = $request->author_id;
        } else {
            $book->author_id = $request->author_id;
        }
        if ($request->author_define) {
            //return $book->publisher_id;
            if ($request->author_define == "Publisher") {
                $book->author_id = $request->author_id;
                $book->publisher_id = $request->author_id;
            }
        }

        $book->book_description = $request->book_description;
        $book->book_amazon_link = $request->book_amazon_link;
        $book->book_ebay_link = $request->book_ebay_link;
        $book->book_discount_in_percentage = $request->book_discount_in_percentage;
        $book->hard_book_price = $request->hard_book_price;
        $book->ebook_price = $request->ebook_price;
        $book->book_price = $request->book_price;
        $book->genere_id = $request->genere_id;
        $book->video_link=$request->video_file_updoad;
        $book->isbn = $request->isbn;

        $book->save();

        if ($request->file_updoad_isbn) {

            $bookDoc = new BookDocuments;
            $bookDoc->book_id = $book->id;
            $bookDoc->type = 'IMAGE';
  
            $bookDoc->path = $request->file_updoad_isbn;
            
            $bookDoc->save();
        }

       

        // if ($request->file_updoad) {

        //     $bookDoc = new BookDocuments;
        //     $bookDoc->book_id = $book->id;
        //     $bookDoc->type = 'IMAGE';
        //     if (isset($request->file_updoad)) {
        //         $file = $request->file('file_updoad');
        //         $extension = $file->getClientOriginalExtension();
        //         $filename = time() . '.' . $extension;
        //         $file->move(public_path('uploads/'), $filename);
        //         $data['path'] = 'public/uploads/' . $filename;
        //         $bookDoc->path = $data['path'];
        //     }
        //     $bookDoc->save();
        // }

        // if ($request->video_file_updoad) {

        //     $bookDoc = new BookDocuments;
        //     $bookDoc->book_id = $book->id;
        //     $bookDoc->type = 'VIDEO';
        //     if (isset($request->video_file_updoad)) {
        //         $file = $request->file('video_file_updoad');
        //         $extension = $file->getClientOriginalExtension();
        //         $filename = time() . '.' . $extension;
        //         $file->move(public_path('uploads/videos/'), $filename);
        //         $data['path'] = 'public/uploads/videos/' . $filename;
        //         $bookDoc->path = $data['path'];
        //     }
        //     $bookDoc->save();
        // }

        return redirect()->back()->with('msg', 'Book added successfully.');
    }


    public function update(Request $request, $id)
    {

        if (!$request->isbn) {
            Session::flash('wrong', 'Isbn is required');
            return back();
        }

        $isbn = $request->isbn; // Replace with the ISBN you want to query
        $apiUrl = "https://api2.isbndb.com/book/{$isbn}";

        $response = Http::withHeaders([
            'Authorization' => env('ISBN_API_KEY'),
            'User-Agent' => 'insomnia/5.12.4',
            'Accept' => '*/*',
        ])->get($apiUrl);

        if ($response->successful()) {
            // Request was successful, process the response
            $bookData = $response->json();
            //dd($bookData);
        } elseif ($response->status() == 404) {
            // Not Found error
            //dd("Error: Not Found");
            Session::flash('wrong', 'Invalid ISBN');
            return back();
        } elseif ($response->status() == 429) {
            // Too Many Requests error
            //dd("Error: Limit Exceeded");
            Session::flash('wrong', 'ISBN Limit Exceeded');
            return back();
        } else {
            // Handle other status codes
            //dd("Error: Unexpected status code {$response->status()}");
            Session::flash('wrong', "Unexpected status code {$response->status()}");
            return back();
        }
        // $validator = Validator::make($request->all(), [
        //     'file_updoad' => 'nullable|mimes:png,jpg',
        // ], [
        //     'file_updoad.mimes' => 'File must be png,jpg',
        // ]);
        // $validator = Validator::make($request->all(), [
        //     'video_file_updoad' => 'nullable|mimes:mp4',
        // ], [
        //     'video_file_updoad.mimes' => 'Video file must be mp4',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withWrong($validator)->withInput();
        //     // You can customize the redirect URL if needed, and withInput() retains the user's input.
        // }

        if (!$request->book_name) {
            Session::flash('wrong', 'Book Name is required');
            return back();
        }
        // if(!$request->author_define)
        // {
        //     Session::flash('wrong','Role is required');
        //     return back();
        // }
        if (!$request->hard_book_price) {
            Session::flash('wrong', 'Hard Book Price is required');
            return back();
        }
        if (!$request->ebook_price) {
            Session::flash('wrong', 'Ebook Price is required');
            return back();
        }
        // if (!$request->video_file_updoad) {
        //     Session::flash('wrong', 'File is required');
        //     return back();
        // }

        if($request->file_updoad)
        {
            $file=$request->file_updoad;
            // Check the file size
            $maxFileSize = 512; // Maximum file size in kilobytes (1 MB)
            $fileSize = $file->getSize();
    
            if ($fileSize > $maxFileSize * 1024) {
                Session::flash('wrong', 'Maximum image file size 512kb');
                return back();
            }
    
        }

        if($request->video_file_updoad)
        {
            $file=$request->video_file_updoad;
            // Check the file size
            $maxFileSize = 5160; // Maximum file size in kilobytes (5 MB)
            $fileSize = $file->getSize();
    
            if ($fileSize > $maxFileSize * 1024) {
                Session::flash('wrong', 'Maximum video file size 5MB');
                return back();
            }
        }
      
    

        // echo '<pre>';print_r($request->all());die;
        $book = Book::find($id);
        $book->book_name = $request->book_name;
        // if ($request->book_author) {
        //     $book->author_id = $request->book_author;
        //     $book->publisher_id = session('author_id');
        // } else {
        //     $book->author_id = session('author_id');
        // }
        // if ($request->author_define) {
        //     if ($request->author_define == "Publisher") {
        //         $book->author_id = session('author_id');
        //     } else {
        //         $book->publisher_id = null;
        //     }
        // }

        $book->book_description = $request->book_description;
        $book->book_amazon_link = $request->book_amazon_link;
        $book->book_ebay_link = $request->book_ebay_link;
        $book->book_discount_in_percentage = $request->book_discount_in_percentage;
        $book->hard_book_price = $request->hard_book_price;
        $book->ebook_price = $request->ebook_price;
        $book->book_price = $request->book_price;
        $book->genere_id = $request->genere_id;
        $book->video_link=$request->video_file_updoad;
        $book->isbn = $request->isbn;

        $book->save();

        if ($request->file_updoad) {
            $bookDoc = new BookDocuments;
            $bookDoc->book_id = $book->id;
            $bookDoc->type = 'IMAGE';
            if (isset($request->file_updoad)) {
                $file = $request->file('file_updoad');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $bookDoc->path = $data['path'];
            }
            $bookDoc->save();
        }

        // if ($request->video_file_updoad) {

        //     $bookDoc = new BookDocuments;
        //     $bookDoc->book_id = $book->id;
        //     $bookDoc->type = 'VIDEO';
        //     if (isset($request->video_file_updoad)) {
        //         $file = $request->file('video_file_updoad');
        //         $extension = $file->getClientOriginalExtension();
        //         $filename = time() . '.' . $extension;
        //         $file->move(public_path('uploads/videos/'), $filename);
        //         $data['path'] = 'public/uploads/videos/' . $filename;
        //         $bookDoc->path = $data['path'];
        //     }
        //     $bookDoc->save();
        // }

        return redirect()->back()->with('success', 'Book updated successfully.');
    }

}
