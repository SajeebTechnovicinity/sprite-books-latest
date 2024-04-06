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
                <h4 class="card-title">Faq Edit</h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('admin/faq/update/' . $faq->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                 
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="title" class="label">Question*</label>
                            <input type="text" name="question" id="title" value="{{ $faq->question }}" class="form-control" />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="title" class="label">Answer*</label>
                            <textarea name="answer" class="form-control" required>{!! $faq->answer !!}</textarea>
                        </div>
                    </div> <!-- /.form-row -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div> <!-- /.col-12 -->
@endsection
