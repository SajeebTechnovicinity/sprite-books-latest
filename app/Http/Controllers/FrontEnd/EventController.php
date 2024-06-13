<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Event;
use App\Models\Settings\Genere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{

    public function index(){
        if(session('author_id') && session('type') == 'AUTHOR'){
            $data['events'] = Event::whereAuthorId(session('author_id'))->orderBy('id','desc')->get();
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
            $data['generes'] = Genere::all();
            // echo '<pre>';print_r( $data['followed_authors']);die;
            return view('frontend.pages.author.event.index',$data);
        }
        else if((session('author_id') && session('type') == 'PUBLISHER'))
        {
            $data['events'] = Event::wherePublisherId(session('author_id'))->orderBy('id','desc')->get();
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
            $data['generes'] = Genere::all();
            // echo '<pre>';print_r( $data['followed_authors']);die;
            return view('frontend.pages.publisher.event.index',$data);
        }
    }

 public function add_events(Request $request){
    $request->validate([
        'event_name' => 'required',
        'event_date' => 'required',
        'image'=>'required|max:512'
    ]);

    $event = new Event;
    $event->event_name = $request->event_name;
    if($request->event_author){
        $event->author_id = $request->event_author;
        $event->publisher_id =session('author_id');
    }else{
        $event->author_id = session('author_id');
    }

    $event->event_description = $request->event_description;
    $event->event_location = $request->event_location;
    $event->event_date = $request->event_date;
    $event->event_link = $request->event_link;
    $event->event_starting_time = $request->event_starting_time;
    $event->event_ending_time = $request->event_ending_time;

    $event->meta_title = $request->meta_title;
    $event->meta_description = $request->meta_description;
    $event->meta_keyword = $request->meta_keyword;

    if ($request->image) {

        if (isset($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/'), $filename);
            $event->image = 'public/uploads/' . $filename;
        }
    }


    $event->save();

    return redirect()->back()->with('msg','Event added successfully.');
 }

 public function update_event(Request $request){
    $request->validate([
        'event_name' => 'required',
        'event_id' => 'required',
        'image'=>'nullable|max:512'
    ]);


    $event = Event::find($request->event_id);
    $event->event_name = $request->event_name;
    if($request->event_author){
        $event->author_id = $request->event_author;
        $event->publisher_id =session('author_id');
    }else{
        $event->author_id = session('author_id');
    }
    $event->event_description = $request->event_description;
    $event->event_location = $request->event_location;
    $event->event_date = $request->event_date;
    $event->event_link = $request->event_link;
    $event->event_starting_time = $request->event_starting_time;
    $event->event_ending_time = $request->event_ending_time;

    $event->meta_title = $request->meta_title;
    $event->meta_description = $request->meta_description;
    $event->meta_keyword = $request->meta_keyword;

    if ($request->image) {
        if (isset($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/'), $filename);
            $event->image = 'public/uploads/' . $filename;
        }
    }
    $event->save();

    return redirect()->back()->with('msg','Event Updated successfully.');
 }
}
