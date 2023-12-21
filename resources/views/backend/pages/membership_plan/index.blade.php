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
            <h4 class="card-title">Membership Plan List</h4>

            <div class="card-tools">
                <a href="{{url('admin/membership-plans/create')}}" class="btn btn-info btn-sm">
                    <i class="fas fa-plus-circle"></i> Add New Membership Plan
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Monthly Price</th>
                        <th>Yearly Price</th>
                        <th>Max Book No</th>
                        <th>Max Event No</th>
                        <th>Max Video Promotion</th>
                        <th>Max Author Account</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $row)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $row->membership_plan_name  }}
                        </td>
                        <td>
                            {{ $row->type }}
                        </td>
                        <td>
                            {{ $row->membership_plan_monthly_price }}
                        </td>
                        <td>
                            {{ $row->membership_plan_yearly_price }}
                        </td>
                        <td>
                            {{ $row->max_no_of_books }}
                        </td>

                        <td>
                            {{ $row->max_no_of_events }}
                        </td>


                        <td>
                            {{ $row->max_no_of_video_promotion }}
                        </td>
                        <td>
                            {{ $row->max_author_account }}
                        </td>

                        <td>
                            {!! $row->membership_plan_description!!}
                        </td>
                        <td>
                            @if($row->membership_plan_status == 1)
                            Published
                            @else
                            Unpublished
                            @endif
                        </td>


                        <td>
                            <div style="white-space: nowrap;">
                                <a class="btn btn-success btn-sm" href="{{url('admin/membership-plans')}}/{{ $row->id }}">
                                    View
                                </a>
                                <a class="btn btn-success btn-sm" href="{{url('admin/membership-plans')}}/{{ $row->id }}/edit">
                                    Edit
                                </a>
                                @if($loop->iteration !== 1)
                                <form method="post" action="{{url('admin/membership-plans/'.$row->id)}}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure !');">Delete</button>
                                </form>
                                @endif
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