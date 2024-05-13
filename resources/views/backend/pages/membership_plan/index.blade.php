@extends('layouts.backend.master')

@section('content')

<style>
    span.select2.select2-container.select2-container--default {
        width: 450px !important;
    }

        .table-des .info span{
            display: block;
        }

        .table-des .info span i{
            color: #777777;
            font-size: 70%;
            margin-right: 5px;
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
            <table class="table table-bordered table-striped table-des">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Information</th>
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

                        <td style="width:20%">
                            <div class="info">
                                <span><i class="fas fa-regular fa-copy"></i> Title:  {{ $row->membership_plan_name  }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> Type:  {{ $row->type }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> Monthly Price: {{ $row->membership_plan_monthly_price }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> Yearly Price:  {{ $row->membership_plan_yearly_price }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> Max Book No: {{ $row->max_no_of_books }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> Max Event No: {{ $row->max_no_of_events }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> Max Video Promotion:  {{ $row->max_no_of_video_promotion }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> Max Author Account:  {{ $row->max_author_account }}</span>
                            </div>
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