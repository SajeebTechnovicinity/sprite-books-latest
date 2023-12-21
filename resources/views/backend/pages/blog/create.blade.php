@extends('layouts.backend.master')

@section('content')

<style>
    span.select2.select2-container.select2-container--default{
        width: 450px !important;
    }
</style>
<br>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Blog Info</h4>
            
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form id="add_form" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="title" class="label">Blog Title*</label>
                        <input type="text" name="blog_name" id="title" class="form-control" />
                    </div>
    
                    <div class="form-group col-md-12">
                        <label for="title" class="label">Blog short Description*</label>
                        <textarea name="blog_short_description" class="form-control"></textarea>
                    </div>
    
                    <div class="form-group col-md-12">
                        <label for="title" class="label">Blog Description*</label>
                        <textarea name="blog_full_description" class="form-control" id="summernote"></textarea>
                    </div>
    
                    <div class="form-group col-md-12">
                        <label for="title" class="label">Blog Image*</label>
                        <input type="file" name="blog_image" id="title" class="form-control" />
                    </div>

                </div>

                <button type="button" id="add_btn" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    
    
</div>

<script>
    
    $("#add_btn").click(function (){
        $('.loader').show();
        setTimeout(function(){
//    alert();
}, 2000);
        $(".error_msg").html('');
        var data = new FormData($('#add_form')[0]);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            method: "POST",
            url: "{{url("admin/blogs")}}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
                
            }
        }).done(function() {
            $('.loader').hide();
            $("#success_msg").html("Data Save Successfully");
             window.location.href = "{{ url('admin/blogs')}}";
        }).fail(function(data, textStatus, jqXHR) {
            $('.loader').hide();
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value){
                $("[name='"+key+"']").after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
        // $('.loader').hide();
    });
  </script>


@endsection


