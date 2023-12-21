@extends('layouts.backend.master')

@section('content')
    <style>
        span.select2.select2-container.select2-container--default {
            width: 450px !important;
        }
    </style>
    <br>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    @if($data->type=="USER")
                        READER
                    @else
                        {{ $data->type }} 
                    @endif          
                
                Edit</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ url('admin/authors/'.$data->id) }}">

                    @csrf

                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $data->id }}">

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="Name">First Name</label>
                            <input type="text" class="form-control" name="author_name" id="name"
                                value="{{ $data->author_name }}" placeholder="Enter First Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">Last Name</label>
                            <input type="text" class="form-control" name="author_last_name" id="name"
                                value="{{ $data->author_last_name }}" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">Email</label>
                            <input type="email" class="form-control" name="author_email" id="email"
                                value="{{ $data->author_email }}" placeholder="Enter Email" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">Phone</label>
                            <input type="text" class="form-control" name="author_phone" id="email"
                                value="{{ $data->author_phone }}" placeholder="Enter Phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name" style="display: block;">Country</label>
                            <select class="form-control" name="author_country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $row)
                                    <option value="{{ $row->name }}" @if ($data->author_country == $row->name) selected @endif>
                                        {{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                    </div>

                    <button type="submit" id="add_btn" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>


    </div>

@endsection
