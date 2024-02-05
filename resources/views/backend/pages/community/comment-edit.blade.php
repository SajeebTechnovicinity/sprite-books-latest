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
                <h4 class="card-title">Comment Edit</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('admin/community/comment/update/' . $communityPostComment->id) }}" method="post"
                    enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" name="comment_id" value="{{ $communityPostComment->id }}">
                    <div class="form-row">



                        <div class="form-group col-md-12">
                            <label for="title" class="label">Title*</label>
                            <input type="text" name="title" id="title"
                                value="{{ $communityPostComment->comment }}" class="form-control" />
                        </div>


                        {{-- <div class="form-group col-md-12">
                            <label for="dsc" class="label">Select Author*</label>
                            <select class="input form-control" name="author_id">
                                @foreach ($authors as $row)
                                    <option value="{{ $row->id }}" @if ($row->id == $communityPostComment->author_id) selected @endif>
                                        {{ $row->communityAuthor->author_name }} {{ $row->communityAuthor->author_last_name }}</option>
                                @endforeach
                            </select>
                        </div> --}}


                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>


    </div>
@endsection
