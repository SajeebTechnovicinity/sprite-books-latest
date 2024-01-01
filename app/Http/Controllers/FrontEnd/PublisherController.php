<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Mail\AuthorMail;
use App\Models\Author;
use App\Models\AuthorFollower;
use App\Models\AuthorMembershipPlan;
use App\Models\Book;
use App\Models\Country;
use App\Models\Event;
use App\Models\FeatureMedia;
use App\Models\MembershipPlan;
use App\Models\Podcast;
use App\Models\Settings\Genere;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PublisherController extends Controller
{
    public function publisher_profile(){
        if(session('author_id')){
            // echo '<pre>';print_r(check_user_max_book_by_user_id(session('author_id')));die;
            $data['books'] = Book::wherePublisherId(session('author_id'))->get();
            $data['events'] = Event::wherePublisherId(session('author_id'))->get();
            $data['author'] = Author::find(session('author_id'));
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
            $data['generes'] = Genere::all();
            $data['podcasts'] = Podcast::whereAuthorId(session('author_id'))->get();
            $data['country_list'] = Country::all();
            $data['author_followers'] = AuthorFollower::whereAuthorId(session('author_id'))->get();
            $data['feature_media'] = FeatureMedia::wherePublisherId(session('author_id'))->get();
            return view('frontend.pages.publisher.profile',$data);
        }
     }

     public function add_author(Request $request)
     {
         // if(Auth::user()->can('add-author')) {
        //   $request->validate([
        //      'name' => 'required',
        //      'email' => 'required',
        //      'phone' => 'required',
        //      'password' => 'required'
        //  ]);
         if($request->name==null || $request->email==null || $request->phone==null || $request->password==null)
         {
            return redirect()->back()->with('msg','Name,Email,Phone,Password is required') ;
         }
         $authorInfo= Author::where('author_email',$request->email)->first();
         if($authorInfo){
            return redirect()->back()->with('msg','Email already used.') ;
         }


             //$authorId = Author::orderBy('id','desc')->first()->id;
             $authorId=rand(10000,99999);

         $author = Author::create([
             'author_name' => $request->name,
             'author_code' => 10000+$authorId,
             'publisher_id' => session('author_id'),
             'author_last_name' => $request->last_name,
             'type' => 'AUTHOR',
             'author_country' => $request->country,
             'author_email_verification' => 1,
             'author_phone' => $request->phone,
             'author_email' => $request->email,
             'author_password' => Hash::make($request->password)
         ]);

        $mailData = [
            'title' => 'Author Creation Email',
            'username'=>$request->name,
            'body' => 'Your password -'.$request->password
        ];
         
        Mail::to($request->email)->send(new AuthorMail($mailData));


         return redirect()->back()->with('msg','Successfully added Author.') ;
         // }
     }


 public function publisher_get_author(Request $request){
    $data['author'] = Author::find($request->id);

    $data['country_list'] = Country::all();
  //   print_r($data['event']);die;
    return view('frontend.pages.publisher.author.edit',$data);
   }

   public function update_author(Request $request){
    $request->validate([
        'name' => 'required',
        'author_id' => 'required',
        'author_email' => [
            'required',
            Rule::unique('author')->ignore($request->author_id),
        ],
    ], [
        'name.required' => 'The name field is required.',
        'author_id.required' => 'The author ID field is required.',
        'author_email.required' => 'The author email field is required.',
        'author_email.unique' => 'The provided email address is already in use by another author.',
    ]);

    // $authorInfo= Author::where('author_email',$request->email)->first();
    //      if($authorInfo){
    //          return 'emailUsed';
    //      }


    $author = Author::find($request->author_id);
    $author->author_name = $request->name;
    $author->author_email = $request->author_email;
    $author->author_last_name = $request->last_name;
    $author->author_country = $request->country;
    $author->author_phone = $request->phone;
    $author->author_password = Hash::make($request->password);
    $author->save();

    return redirect()->back()->with('msg','Author Updated successfully.');
 }

 public function delete_author($id){
   Author::find($id)->delete();
   return redirect()->back()->with('msg','Author has been deleted successfully.');
 }

 public function add_feature_media(Request $request){
    // echo '<pre>';print_r($request->all());die;
    // $request->validate([
    //     'file' => 'required'
    // ]);

    if(!$request->file)
    {
        Session::put('wrong','File is required');
        return back();
    }



    $media = new FeatureMedia;

    if($request->file){


        $media->publisher_id =session('author_id');
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



    return redirect()->back()->with('msg','Feature media added successfully.');
 }

 public function membership_plan(){
    if(session('author_id')){
        $data['author'] = Author::find(session('author_id'));
        $data['membership_plans'] = MembershipPlan::whereMembershipPlanStatus(1)->whereType(session('type'))->get();
        $data['current_membership_plans'] = AuthorMembershipPlan::whereAuthorId(session('author_id'))->whereType(session('type'))->latest()->take(1)->get();
        //   echo '<pre>';print_r($data['membership_plans']);die;
        // return $data['current_membership_plans'];
        return view('frontend.pages.publisher.membership_plan',$data);
    }
 }

}
