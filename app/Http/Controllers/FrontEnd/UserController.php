<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\AuthorFollower;
use App\Models\AuthorMembershipPlan;
use App\Models\Book;
use App\Models\BookLibraries;
use App\Models\Community;
use App\Models\CommunityMembers;
use App\Models\Event;
use App\Models\ReaderGenere;
use App\Models\Settings\Genere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function registration(){
        return view('frontend.pages.account.user.register');
    }

    public function login(){
        return view('frontend.pages.account.user.login');
    }



    public function submit_registration(Request $request){
        Session::put('author_name',$request->author_name);
        Session::put('author_last_name',$request->author_last_name);
        Session::put('email',$request->email);
        // $request->validate([
        //     'email' => 'required',
        //     'password'=>'required',
        //     'confirm_password'=>'required'
        // ]);
        if(!$request->email)
        {
            return redirect()->back()->with('msg',"Email is required.");
        }
        if(!$request->password)
        {
            return redirect()->back()->with('msg',"Password is required.");
        }
        if(!$request->author_name)
        {
            return redirect()->back()->with('msg',"First Name is required.");
        }
        if(!$request->author_last_name)
        {
            return redirect()->back()->with('msg',"Last Name is required.");
        }
        if(!$request->name && $request->type=="PUBLISHER")
        {
            return redirect()->back()->with('msg',"Publisher Name is required.");
        }
        $authorInfo= Author::where('author_email',$request->email)->first();
        if($request->password != $request->confirm_password)
        {
            return redirect()->back()->with('msg',"Password and Confirm password do not match.");
        }
        if($authorInfo){
            return redirect()->back()->with('msg',"Credentials already used by another user.");
        }

        if(Author::count()!=0)
        {
            $authorId = Author::orderBy('id','desc')->first()->id;
        }
        else
        {
            $authorId = 1;
        }

        $authorId=rand(10000,999999);

        $author = Author::create([
            'name'=>$request->name,
            'author_name' => $request->author_name,
            'type'=>$request->type,
            'author_code' => 10000+$authorId,
            'author_last_name' => $request->author_last_name,
            'author_email_verification' => 1,
            'author_membership_status' => 0,
            'author_email' => $request->email,
            'author_password' => Hash::make($request->password)
        ]);







if($author->type == 'USER'){
    $sData = [
        'author_name'=>$author->author_name,
        'author_phone'=>$author->author_phone,
        'type'=>$author->type,
        'author_code'=>$author->author_code,
        'author_email'=>$author->author_email,
        'author_id'=>$author->id,
    ];
    session()->put($sData);

        return redirect('user/generes')->with('msg','User added successfully.');
}else{
    $sData = [
        'waiting_for_author_membership_id'=>$author->id,
        'type'=>$author->type,
    ];
    session()->put($sData);
    return redirect('select-membership-plan')->with('msg',"'.$author->type.' added successfully.");
}

    }

    public function submit_login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        Session::put('email',$request->email);



        $author = Author::where('author_email', $request->email)->where('author_email_verification',1)->where('is_delete',0)->first();

        if(!$author){
            return redirect()->back()->with('msg','No user found with this credential');
        }




        if ($author) {
            if (Hash::check($request->password, $author->author_password)) {

                $sData = [
                    'author_name'=>$author->author_name,
                    'author_phone'=>$author->author_phone,
                    'type'=>$author->type,
                    'author_code'=>$author->author_code,
                    'author_email'=>$author->author_email,
                    'author_id'=>$author->id,
                ];

                if(AuthorMembershipPlan::where('author_id',$author->id)->count()==0 && $author->type!="USER")
                {

                    $sData = [
                        'waiting_for_author_membership_id' => $author->id,
                        'type' => $author->type,
                    ];
                    session()->put($sData);
                    return redirect('select-membership-plan');
                }


                if(AuthorMembershipPlan::where('author_id',$author->id)->exists() && $author->type!="USER")
                {



                    $authorMembership=AuthorMembershipPlan::where('author_id',$author->id)->first();

                    $expireCondition=0;

                    $subscription_count= DB::table('subscriptions')->where('author_id', $author->id)->where('stripe_status','inactive')->count();


                    //$subscription= DB::table('subscriptions')->where('author_id', $author->id)->where('stripe_status','inactive')->latest()->take(1)->get()[0];

                    if($subscription_count>0 || ($authorMembership->membership_plan_id==2 || $authorMembership->membership_plan_id==3 || $authorMembership->membership_plan_id==11 || $authorMembership->membership_plan_id==12) )
                    {
                        $expireCondition=1;
                    }




                    if ( $expireCondition==1) {
                        if ($authorMembership->duration == "Monthly") {
                            // Calculate one month after the membership creation date
                            $oneMonthAfter = $authorMembership->created_at->addMonth();

                            // Check if the current date is after one month after membership creation
                            if (now() > $oneMonthAfter) {
                                // Membership has expired, redirect to select a new membership plan
                                $sData = [
                                    'waiting_for_author_membership_id' => $author->id,
                                    'type' => $author->type,
                                ];
                                session()->put($sData);
                                AuthorMembershipPlan::where('author_id',$author->id)->delete();
                                return redirect('select-membership-plan');
                            }
                        } elseif ($authorMembership->duration == "Yearly") {
                            // Calculate one year after the membership creation date
                            $oneYearAfter = $authorMembership->created_at->addYear();

                            // Check if the current date is after one year after membership creation
                            if (now() > $oneYearAfter) {
                                // Membership has expired, redirect to select a new membership plan
                                $sData = [
                                    'waiting_for_author_membership_id' => $author->id,
                                    'type' => $author->type,
                                ];
                                session()->put($sData);
                                AuthorMembershipPlan::where('author_id',$author->id)->delete();
                                return redirect('select-membership-plan');
                            }
                        }
                    }

                }

                session()->put($sData);
                if($author->type == 'AUTHOR'){
                    return redirect('author/profile');
                }elseif($author->type == 'USER'){
                    return redirect('user/profile');
                }elseif($author->type == 'PUBLISHER'){
                    return redirect('publisher/profile');
                }

            } else {
                return redirect()->back()->with('msg','Credential do not match');
                return 'error';
                return ['data'=>$author,'status'=>0];
            }
        } else {
            return ['data'=>$author,'status'=>0];
        }



        return redirect('author/profile');

    }

    public function save_generes(Request $request){
        // echo '<pre>';print_r($request->all());die;
        if(session('author_id')){
            foreach($request->generes as $row){
                $readerGenere = new ReaderGenere;
                $readerGenere->genere_id = $row;
                $readerGenere->reader_id = session('author_id');
                $readerGenere->save();
            }
        }
        return redirect('user/profile')->with('msg','Generes saved successfully.');
    }

    public function user_profile(){
        if(session('author_id')){
        $data['author'] = Author::whereType('USER')->whereId(session('author_id'))->get();
        $data['user_following'] = AuthorFollower::whereType('USER')->whereUserId(session('author_id'))->get();
        // echo '<pre>';print_r( $data['author'][0]->author_profile_picture);die;
        return view('frontend.pages.user.profile',$data);
        }else{
            return redirect('/');
        }
    }

    public function user_generes(){
        if(session('author_id')){
            $data['user'] = Author::whereType('USER')->whereId(session('author_id'))->get();
            $data['generes'] = Genere::all();
            // echo '<pre>';print_r( $data['author'][0]->author_profile_picture);die;
            return view('frontend.pages.user.genere.index',$data);
            }else{
                return redirect('/');
            }
    }

    public function user_public_profile($userId){
        if(session('author_id')){
        $data['author'] = Author::whereType('USER')->whereId($userId)->get();
        $data['user_following'] = AuthorFollower::whereType('USER')->whereUserId($userId)->get();
        // echo '<pre>';print_r( $data['author'][0]->author_profile_picture);die;
        return view('frontend.pages.user.public_profile',$data);
        }else{
            return redirect('/');
        }
    }



    public function dashboard(){
        if(session('author_id') && session('type') == 'USER'){
            $data['authors'] = Author::whereType('AUTHOR')->orderBy('id','desc')->get();
            $data['followed_authors'] = AuthorFollower::whereType('USER')->whereFollowedBy(session('author_id'))->orderBy('id','desc')->get();
            // echo '<pre>';print_r( $data['followed_authors']);die;
            return view('frontend.pages.user.dashboard',$data);
        }
     }


    public function author(){
        if(session('author_id') && session('type') == 'USER'){
            $data['followed_authors'] = AuthorFollower::whereType('USER')->whereFollowedBy(session('author_id'))->orderBy('id','desc')->get();
            // echo '<pre>';print_r( $data['followed_authors']);die;
            return view('frontend.pages.user.author.index',$data);
        }
     }

     public function community(){
        if(session('author_id') && session('type') == 'USER'){
            $data['my_communities'] = CommunityMembers::whereType('USER')->whereJoinedBy(session('author_id'))->orderBy('id','desc')->get();

            $myCommunity = '';
            $count = 0;
            foreach($data['my_communities'] as $row){
                if($count == 0){$nData = $row->community_id;}else{ $nData = ','.$row->community_id; };
                 $myCommunity .= $nData;
                 $count++;
            }

            $data['communities'] = Community::where('id','!=',[$myCommunity])->orderBy('id','desc')->limit(15)->get();
            // echo '<pre>';print_r($myCommunity);die;
            return view('frontend.pages.user.community.index',$data);
        }
        else
        {
            return redirect('user/login');
        }
     }

     public function library(){
        if(session('author_id') && session('type') == 'USER'){
            $readerGeneres = ReaderGenere::whereReaderId(session('author_id'))->get('genere_id');
            // echo '<pre>';print_r($readerGeneresArray);die;
            $data['books'] = Book::whereIn('genere_id', $readerGeneres)->where('is_delete',0)->orderBy('id','desc')->paginate(10);
            $data['mylibraries'] = BookLibraries::whereType('USER')->whereAddedBy(session('author_id'))->orderBy('id','desc')->get();

            return view('frontend.pages.user.library.index',$data);
        }
     }

     public function event(){
        if(session('author_id') && session('type') == 'USER'){
            $data['events'] = Event::where('is_delete',0)->orderBy('id','desc')->get();
            // echo '<pre>';print_r( $data['followed_authors']);die;
            return view('frontend.pages.user.event.index',$data);
        }
     }



     public function book_add_to_library(Request $request){

        if($request->book_id){
            $BookLibraries = new BookLibraries;
            $BookLibraries->type = 'USER';
            $BookLibraries->book_id = $request->book_id;
            $BookLibraries->added_by = session('author_id');
            $BookLibraries->user_id = session('author_id');
            $BookLibraries->save();

            return ['data'=>$BookLibraries,'status'=>1];
        }
     }


     public function remove_book_from_library(Request $request){
        if($request->id){
            $new = BookLibraries::find($request->id)->delete();
            return ['data'=>$new,'status'=>1];
        }
     }







}
