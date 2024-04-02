<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\AuthorFollower;
use App\Models\AuthorMembershipPlan;
use App\Models\Book;
use App\Models\BookDocuments;
use App\Models\Country;
use App\Models\Event;
use App\Models\FeatureMedia;
use App\Models\MembershipPlan;
use App\Models\Podcast;
use App\Models\ReaderGenere;
use App\Models\Settings\Genere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class AuthorController extends Controller
{
    public function author_login()
    {
        return view('frontend.pages.account.author.login');
    }

    public function getTopAuthors($topCount = 10)
    {
        if (session('author_id')) {
            $data['author'] = Author::whereId(session('author_id'))->get();
            $data['generes'] = Genere::all();
        
            // Retrieve authors and their follower counts
            $authorsWithFollowerCounts = Author::
            select(
                'author.id',          // Include all selected columns from the author table
                'author.author_name',
                'author.author_email',
                'author.type',
                'author.created_at',
                DB::raw('COUNT(author_followers.id) as follower_count')
            )
            ->leftJoin('author_followers', 'author.id', '=', 'author_followers.author_id')
            ->where('author.type', 'AUTHOR')
            ->groupBy(            // Include all selected columns from the author table
                'author.id',
                'author.author_name',
                'author.author_email',
                'author.type',
                'author.created_at'
            )
            ->orderByDesc('follower_count')
            ->take($topCount)
            ->get();
        
            $data['authors'] = $authorsWithFollowerCounts;
        
            $data['followed_authors'] = AuthorFollower::whereType('AUTHOR')
                ->whereFollowedBy(session('author_id'))
                ->orderBy('id', 'desc')
                ->get();
            
            //return $data['followed_authors'];
            return view('frontend.pages.author.dashboard', $data);
        }
    }


    public function post_author_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

      

        $author = Author::where('author_email', $request->email)->where('author_email_verification', 1)->first();

        if (!$author) {
            return 'error';
        }




        if ($author) {
            if (Hash::check($request->password, $author->author_password)) {

                // if(!AuthorMembershipPlan::where('author_id',$author->id)->exists())
                // {
                //     $sData = [
                //         'waiting_for_author_membership_id'=>$author->id,
                //         'type'=>$author->type,
                //     ];
                //     session()->put($sData);
                //     return redirect('select-membership-plan')->with('msg',"'.$author->type.' added successfully.");
                // }

                //return 1;

                $sData = [
                    'author_name' => $author->author_name,
                    'type' => 'AUTHOR',
                    'author_phone' => $author->author_phone,
                    'author_code' => $author->author_code,
                    'author_email' => $author->author_email,
                    'author_id' => $author->id,
                ];

                session()->put($sData);

                return redirect('author/profile');
            } else {
                return 'error';
                return ['data' => $author, 'status' => 0];
            }
        } else {
            return ['data' => $author, 'status' => 0];
        }

        


        return redirect('author/profile');
    }

    public function author_profile()
    {
        if (session('author_id')) {

            $author=Author::where('id',session('author_id'))->first();

            //return $author;

            if(!AuthorMembershipPlan::where('author_id',session('author_id'))->exists() && $author->type!="USER")
            {
                $sData = [
                        'waiting_for_author_membership_id'=>$author->id,
                        'type'=>$author->type,
                ];
                session()->put($sData);                
                return redirect('select-membership-plan');
            }
            //return(check_user_max_book_by_user_id(session('author_id')));
            //  echo '<pre>';print_r(check_user_max_book_by_user_id(session('author_id')));die;
            $data['books'] = Book::whereAuthorId(session('author_id'))->where('is_delete',0)->get();
            $data['events'] = Event::whereAuthorId(session('author_id'))->where('is_delete',0)->get();
            $data['author'] = Author::find(session('author_id'));
            $data['generes'] = Genere::all();
            $data['podcasts'] = Podcast::whereAuthorId(session('author_id'))->get();
            $data['feature_media'] = FeatureMedia::whereAuthorId(session('author_id'))->get();
            $data['author_followers'] = AuthorFollower::whereAuthorId(session('author_id'))->get();
            return view('frontend.pages.author.profile', $data);
        }
    }

    public function author_public_profile($authorId)
    {
        if ($authorId) {
            $data['books'] = Book::whereAuthorId($authorId)->where('is_delete',0)->get();
            $data['events'] = Event::whereAuthorId($authorId)->where('is_delete',0)->get();
            $data['author'] = Author::find($authorId);
            $data['author_followers'] = AuthorFollower::whereAuthorId($authorId)->get();
            $data['feature_media'] = FeatureMedia::whereAuthorId(session('author_id'))->get();
            $data['podcasts'] = Podcast::whereAuthorId($authorId)->get();
            return view('frontend.pages.author.public_profile', $data);
        }
    }

    public function author_public_events($authorId)
    {
        if ($authorId) {
            $data['events'] = Event::whereAuthorId($authorId)->where('is_delete',0)->get();
            // echo '<pre>';print_r($data['events'] );die;
            $data['author'] = Author::find($authorId);
            return view('frontend.pages.author.public_events', $data);
        }
    }



    public function author_settings()
    {
        if (session('author_id')) {
            $data['author'] = Author::find(session('author_id'));
            $data['country_list'] = Country::all();
            $data['generes'] = Genere::all();
            $data['user_generes'] = ReaderGenere::where('reader_id', session('author_id'))->get();
            return view('frontend.pages.settings', $data);
        }
    }

    public function membership_plan()
    {
        if (session('author_id')) {
            $data['author'] = Author::find(session('author_id'));
            $data['membership_plans'] = MembershipPlan::whereMembershipPlanStatus(1)->whereType(session('type'))->get();
            $data['current_membership_plans'] = AuthorMembershipPlan::whereAuthorId(session('author_id'))->whereType(session('type'))->latest()->take(1)->get();
            return view('frontend.pages.author.membership_plan', $data);
        }
    }

    public function dashboard()
    {
        if (session('author_id')) {
            $data['author'] = Author::whereId(session('author_id'))->get();
            $data['authors'] = Author::whereType('AUTHOR')->orderBy('id', 'desc')->get();
            $data['generes'] = Genere::all();
            $data['followed_authors'] = AuthorFollower::whereType('AUTHOR')->whereFollowedBy(session('author_id'))->orderBy('id', 'desc')->get();
            return view('frontend.pages.author.dashboard', $data);
        }
    }




    public function add_feature_media(Request $request)
    {
        // echo '<pre>';print_r($request->all());die;
        if (!$request->file) {
            Session::put('wrong', 'File is required');
            return back();
        }

        // Retrieve the file from the request
        $file = $request->file('file');

        // Check if the file is not null
        if (!$file) {
            Session::put('wrong', 'Invalid file');
            return back();
        }

        // Check the file size
        $maxFileSize = 2048; // Maximum file size in kilobytes (2 MB)
        $fileSize = $file->getSize();

        if ($fileSize > $maxFileSize * 1024) {
            Session::put('wrong', 'Maximum File size is 2 MB');
            return back();
        }

         // Check the file type
        $allowedFileTypes = ['jpg', 'jpeg', 'png', 'pdf','mp4']; // Specify the allowed file types/extensions

        if (!$file->getClientOriginalExtension() || !in_array($file->getClientOriginalExtension(), $allowedFileTypes)) {
            Session::put('wrong', 'Invalid file type. Allowed types are: ' . implode(', ', $allowedFileTypes));
            return back();
        }

        $media = new FeatureMedia;

        if ($request->file) {


            $media->author_id = session('author_id');
            $media->type = session('type');
            if (isset($request->file)) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $media->path = $data['path'];
            }
            $media->save();
        }



        return redirect()->back()->with('msg', 'Feature media added successfully.');
    }



    public function add_books(Request $request)
    {

        //return $request;

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
            $book->publisher_id = session('author_id');
        } else {
            $book->author_id = session('author_id');
        }
        if ($request->author_define) {
            //return $book->publisher_id;
            if ($request->author_define == "Publisher") {
                $book->author_id = session('author_id');
                $book->publisher_id = session('author_id');
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

    public function update_books(Request $request, $id)
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
        // if (!$request->ebook_price) {
        //     Session::flash('wrong', 'Ebook Price is required');
        //     return back();
        // }
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

        // if($request->video_file_updoad)
        // {
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
        $book = Book::find($id);
        $book->book_name = $request->book_name;
        if ($request->book_author) {
            $book->author_id = $request->book_author;
            $book->publisher_id = session('author_id');
        } else {
            $book->author_id = session('author_id');
        }
        if ($request->author_define) {
            if ($request->author_define == "Publisher") {
                $book->author_id = session('author_id');
            } else {
                $book->publisher_id = null;
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

    public function save_informations(Request $request)
    {
        $request->validate([
            'file_updoad' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg|max:2048', // Maximum file size is 2 MB
            'cover_picture' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg|max:3172', // Maximum file size is 3 MB
            //'author_intro_video' => 'nullable|mimetypes:video/mp4,video/mpeg,video/quicktime|max:5160', // Maximum file size is 5 MB // Maximum file size is 1 MB
        ], [
            'file_updoad.mimetypes' => 'Profile picture must be a JPEG or PNG image.',
            'cover_picture.mimetypes' => 'Cover Image must be a JPEG or PNG image.',
            'file_updoad.max' => 'Profile picture must not exceed 2 MB in size.',
            'cover_picture.max' => 'Cover Image must not exceed 3 MB in size.',
            'author_intro_video.mimetypes' => 'Intro video must be in MP4, MPEG, or QuickTime format.',
            //'author_intro_video.max' => 'Intro video must not exceed 5 MB in size.',
        ]);
        // echo '<pre>';print_r($request->all());die;
        $author = Author::find(session('author_id'));
        $author->author_bio = $request->author_bio;
        $author->author_description = $request->author_description;
        $author->author_country = $request->author_country;
        $author->author_website_link = $request->author_website_link;
        $author->author_youtube_link = $request->author_youtube_link;
        $author->author_facebook_link = $request->author_facebook_link;
        $author->author_twitter_link = $request->author_twitter_link;
        $author->author_instagram_link = $request->author_instagram_link;
        $author->author_linkedin_link = $request->author_linkedin_link;
        $author->author_pinterest_link = $request->author_pinterest_link;
        $author->author_spotify_link = $request->author_spotify_link;
        $author->author_podcast_link = $request->author_podcast_link;

        $author->author_intro_video=$request->author_intro_video;

        if ($request->file_updoad) {

            if (isset($request->file_updoad)) {
                $file = $request->file('file_updoad');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '1.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $author->author_profile_picture = $data['path'];
            }
        }

        if ($request->cover_picture) {

            if (isset($request->cover_picture)) {
                $file = $request->file('cover_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '2.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $author->author_cover_picture = $data['path'];
            }
        }

        // if ($request->author_intro_video) {

        //     if (isset($request->author_intro_video)) {
        //         $file = $request->file('author_intro_video');
        //         $extension = $file->getClientOriginalExtension();
        //         $filename = time() . '3.' . $extension;
        //         $file->move(public_path('uploads/'), $filename);
        //         $data['path'] = 'public/uploads/' . $filename;
        //         $author->author_intro_video = $data['path'];
        //     }
        // }

        if (session('author_id')) {

            if ($request->generes) {
                ReaderGenere::where('reader_id', session('author_id'))->delete();
                foreach ($request->generes as $row) {
                    $readerGenere = new ReaderGenere;
                    $readerGenere->genere_id = $row;
                    $readerGenere->reader_id = session('author_id');
                    $readerGenere->save();
                }
            }
        }



        $author->save();

        if (session('type') == 'AUTHOR') {
            return redirect('author/profile')->with('msg', 'Information saved successfully.');
        } elseif (session('type') == 'USER') {
            return redirect('user/profile')->with('msg', 'Information saved successfully.');
        } elseif (session('type') == 'PUBLISHER') {
            return redirect('publisher/profile')->with('msg', 'Information saved successfully.');
        }
    }

    public function follow_author(Request $request)
    {

        if (!session('author_id')) {
            return ['data' => 'Please login first.', 'status' => 0];
        }
        //return $request->author_id;
        if (AuthorFollower::whereAuthorId($request->author_id)->whereFollowedAuthorId(session('author_id'))->orWhere('user_id', session('author_id'))->get()->isNotEmpty()) {
            return ['data' => 'You are already following this author.', 'status' => 0];
        }

        if ($request->author_id) {
            if (session('type') == 'AUTHOR') {
                $check = AuthorFollower::whereType('AUTHOR')->whereAuthorId($request->author_id)->whereFollowedAuthorId(session('author_id'))->get();
                if ($check->isEmpty()) {
                    $newFollower = new AuthorFollower;
                    $newFollower->type = 'AUTHOR';
                    $newFollower->author_id = $request->author_id;
                    $newFollower->followed_by = session('author_id');
                    $newFollower->followed_author_id = session('author_id');
                    $newFollower->save();

                    return ['data' => $newFollower, 'status' => 1];
                }
            } else {
                $check = AuthorFollower::whereType('USER')->whereAuthorId($request->author_id)->whereUserId(session('author_id'))->get();
                if ($check->isEmpty()) {
                    $newFollower = new AuthorFollower;
                    $newFollower->type = 'USER';
                    $newFollower->author_id = $request->author_id;
                    $newFollower->followed_by = session('author_id');
                    $newFollower->user_id = session('author_id');
                    $newFollower->save();

                    return ['data' => $newFollower, 'status' => 1];
                }
            }
        }
    }

    public function follow_author_now(Request $request)
    {
        if ($request->user_id && $request->author_id) {
            $check = AuthorFollower::whereUserId($request->user_id)->whereAuthorId($request->author_id)->get();
            if ($check->isEmpty()) {
                $newFollower = new AuthorFollower;
                $newFollower->type = 'USER';
                $newFollower->author_id = $request->author_id;
                $newFollower->followed_by = $request->user_id;
                $newFollower->user_id = $request->user_id;
                $newFollower->save();

                return ['data' => $newFollower, 'status' => 1];
            }
        }
    }



    public function unfollow_author(Request $request)
    {
        if ($request->id) {
            $newFollower = AuthorFollower::find($request->id)->delete();
            return ['data' => $newFollower, 'status' => 1];
        }
    }

    public function unfollow_author_now(Request $request)
    {
        if ($request->user_id && $request->author_id) {
            $newFollower = AuthorFollower::whereUserId($request->user_id)->whereAuthorId($request->author_id)->delete();
            return ['data' => $newFollower, 'status' => 1];
        }
    }

    public function authors_get_event(Request $request)
    {
        $data['event'] = Event::find($request->id);
        if (session('type') == 'PUBLISHER') {
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
        }
        //   print_r($data['event']);die;
        return view('frontend.pages.author.event.edit', $data);
    }
}
