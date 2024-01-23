<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $data['list'] = Event::where('is_delete',0)->orderBy('id', 'desc')->get();
        return view("backend.pages.event.index", $data);
    }
    public function delete_event($id){

        $event = Event::find($id);
        $event->is_delete = 1;
    
        $event->save();
    
        return redirect()->back()->with('success', 'Event delete successfully');
     }
}
