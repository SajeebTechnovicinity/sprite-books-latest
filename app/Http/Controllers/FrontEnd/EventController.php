<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{

    public function index(){
        if(session('author_id') && session('type') == 'AUTHOR'){
            $data['events'] = Event::whereAuthorId(session('author_id'))->orderBy('id','desc')->get();
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
            // echo '<pre>';print_r( $data['followed_authors']);die;
            return view('frontend.pages.author.event.index',$data);
        }
        else if((session('author_id') && session('type') == 'PUBLISHER'))
        {
            $data['events'] = Event::wherePublisherId(session('author_id'))->orderBy('id','desc')->get();
            $data['author_created_list'] = Author::wherePublisherId(session('author_id'))->latest()->get();
            // echo '<pre>';print_r( $data['followed_authors']);die;
            return view('frontend.pages.publisher.event.index',$data);
        }
    }

 public function add_events(Request $request){
    $request->validate([
        'event_name' => 'required',
        'event_date' => 'required'
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
    $event->save();

    return redirect()->back()->with('msg','Event added successfully.');
 }

 public function update_event(Request $request){
    $request->validate([
        'event_name' => 'required',
        'event_id' => 'required'
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
    $event->save();

    return redirect()->back()->with('msg','Event Updated successfully.');
 }
}
