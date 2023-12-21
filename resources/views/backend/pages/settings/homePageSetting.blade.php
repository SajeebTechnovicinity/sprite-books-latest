@extends('layouts.backend.master')

@section('content')

    <style>
        span.select2.select2-container.select2-container--default{
            width: 450px !important;
        }
    </style>
    <br>
    <br>
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: 700;">Home Page Setting</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/home/page/setting/store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <label>Top Image</label>
                                <input type="file" class="form-control" name="top_img" placeholder="img">
                            </div>
                            <div class="col">
                                <label>Service</label>
                                <input type="text" class="form-control" value="{{$home->service}}" name="service" placeholder="service">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label>Open Date</label>
                                <input type="text" class="form-control" value="{{$home->open_end_date}}" name="open_end_date" placeholder="Open End Time">
                            </div>
                            <div class="col">
                                <label>Inquiries</label>
                                <input type="text" class="form-control" value="{{$home->inquiries}}" name="inquiries" placeholder="Inquiries">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label>Requests</label>
                                <input type="text" class="form-control" value="{{$home->requests}}" name="requests" placeholder="Requests">
                            </div>
                            <div class="col">
                                <label>Mail</label>
                                <input type="text" class="form-control" value="{{$home->mail}}" name="mail" placeholder="Mail">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label>Fate Txt</label>
                                <input type="text" class="form-control" value="{{$home->flat_fate}}" name="flat_fate" placeholder="Fate Txt">
                            </div>
                            <div class="col">
                                <label>Fate Details</label>
                                <input type="text" class="form-control" value="{{$home->flat_fate_details}}" name="flat_fate_details" placeholder="Fate Details">
                            </div>
                        </div>


                        <br>
                        <br>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





@endsection


