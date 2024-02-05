@extends('layouts.backend.master')

@section('content')
    <style>
        span.select2.select2-container.select2-container--default {
            width: 450px !important;
        }
    </style>
    <br>
    <a href="{{ url()->previous() }}" style="float:right;" class="btn btn-primary">Back</a>
    <br>
    <br>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Community Edit</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('admin/community/update/' . $community->id) }}" method="post"
                    enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" name="community_id" value="{{ $community->id }}">
                    <div class="form-row">



                        <div class="form-group col-md-12">
                            <label for="title" class="label">Community Name*</label>
                            <input type="text" name="community_name" id="title"
                                value="{{ $community->community_name }}" class="form-control" />
                        </div>


                        {{-- <div class="form-group col-md-12">
                            <label for="dsc" class="label">Select Author*</label>
                            <select class="input form-control" name="author_id">
                                @foreach ($authors as $row)
                                    <option value="{{ $row->id }}" @if ($row->id == $community->author_id) selected @endif>
                                        {{ $row->communityAuthor->author_name }} {{ $row->communityAuthor->author_last_name }}</option>
                                @endforeach
                            </select>
                        </div> --}}



                        <div class="form-group col-md-12">
                            <label for="title" class="label">Description*</label>
                            <textarea name="community_description" class="form-control" required>{!! $community->community_description !!}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                              <label for="title" class="label">
                                
                                Attach File(Max 512 KB) (Recommanded: 300x300 px)
                            </label>
             
                            
                            
                            <br>
                            <input class="attach-input" type="file" name="file_updoad" id="attach-file" accept="image/*"
                                 />
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>


    </div>
@endsection
