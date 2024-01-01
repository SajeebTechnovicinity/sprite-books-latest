<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Event;
use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
public function index(){
    $data['author'] = Author::find(session('author_id'));
    $data['podcasts'] = Podcast::whereAuthorId(session('author_id'))->get();
    return view('frontend.pages.author.podcast.index',$data);
}

public function show($id){
    $data['podcast'] = Podcast::find($id);
//   print_r($data['event']);die;
  return view('frontend.pages.author.podcast.edit',$data);
}

public function store(Request $request){

     $request->validate([
        'podcast_name' => 'required',
        'podcast_embed_code' => [
            'required',
            // 'regex:/^(<iframe.*<\/iframe>|<embed.*<\/embed>|<object.*<\/object>|<video.*<\/video>|<audio.*<\/audio>|<a.*<\/a>)$/'
        ],
    ], [
        'podcast_name.required' => 'The podcast name field is required.',
        'podcast_embed_code.required' => 'The podcast embed code field is required.',
        'podcast_embed_code.regex' => 'Invalid podcast embed code format.',
    ]);

    // echo '<pre>';print_r($request->all());die;
    $podcast = new Podcast;
    $podcast->podcast_name = $request->podcast_name;
    $podcast->author_id = session('author_id');
    $podcast->podcast_embed_code = $request->podcast_embed_code;
    
    $podcast->save();

    return redirect()->back()->with('msg','Podcast added successfully.');
 }

 public function update_podcast(Request $request){

    $request->validate([
        'podcast_name' => 'required',
        'podcast_embed_code' => [
            'required',
            // 'regex:/^(<iframe.*<\/iframe>|<embed.*<\/embed>|<object.*<\/object>|<video.*<\/video>|<audio.*<\/audio>|<a.*<\/a>)$/'
        ],
    ], [
        'podcast_name.required' => 'The podcast name field is required.',
        'podcast_embed_code.required' => 'The podcast embed code field is required.',
        'podcast_embed_code.regex' => 'Invalid podcast embed code format.',
    ]);

    // echo '<pre>';print_r($request->all());die;
    $podcast = Podcast::find($request->podcast_id);
    $podcast->podcast_name = $request->podcast_name;
    $podcast->author_id = session('author_id');
    $podcast->podcast_embed_code = $request->podcast_embed_code;
    
    $podcast->save();

    return redirect()->back()->with('msg','Podcast Updated successfully.');

 }

}
