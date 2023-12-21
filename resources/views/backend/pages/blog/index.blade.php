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
                <h4 class="card-title">Users List</h4>

                <div class="card-tools">
                    <a href="{{ url('admin/users/create') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-plus-circle"></i> Add New User
                    </a>
                </div>
            </div>
              @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('wrong'))
                    <div class="alert alert-danger">
                        {{ Session::get('wrong') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Usertype</th>
                            <th>User Name</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    @if($row->usertype==null)
                                        Admin
                                    @else
                                        {{ $row->usertype }}
                                    @endif
                                </td>
                                <td>
                                    @if ($row->author_id)
                                        {{ $row->author->author_name }}
                                    @endif
                                </td>
                                <td>
                                    {{ $row->blog_name }}
                                </td>
                                <td>
                                    {{ $row->blog_short_description }}
                                </td>

                                <td>
                                    <img height="60px" width="60px" src="{{ asset($row->blog_image) }}">
                                </td>
                                <td>
                                    @if($row->status==1)
                                        Approved
                                    @else
                                        Pending
                                    @endif
                                </td>


                                <td>
                                    <div class="row">
                                        @if($row->status!=1)
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('admin/blogs/approve') }}/{{ $row->id }}" style="margin-right: 5px;">
                                                Approve
                                            </a>
                                        @endif
                                        <a class="btn btn-success btn-sm"
                                            href="{{ url('admin/blogs') }}/{{ $row->id }}" style="margin-right: 5px;">
                                            View
                                        </a>
                                        <a class="btn btn-success btn-sm"
                                            href="{{ url('admin/blogs') }}/{{ $row->id }}/edit"
                                            style="margin-right: 5px;">
                                            Edit
                                        </a>
                                        <form method="post" action="{{ url('admin/blogs/' . $row->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure !');">Delete</button>
                                        </form>

                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
