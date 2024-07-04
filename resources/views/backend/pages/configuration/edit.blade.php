@extends('layouts.backend.master')

@section('content')
    <style>
        span.select2.select2-container.select2-container--default {
            width: 450px !important;
        }

        .conf-top label {
            display: block;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .conf-top {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-gap: 30px;
            list-style: none;
            padding: 0 0 20px;
        }

        @media (min-width:1400px) and (max-width: 1600px) {
            .conf-top {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width:680px) and (max-width: 1399px) {
            .conf-top {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 679px) {
            .conf-top {
                grid-template-columns: repeat(1, 1fr);
            }
        }

        .conf-top li img {
            max-height: 100px;
            max-width: 100%;
        }

        .conf-top li {
            padding: 22px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }
    </style>
    <br>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Configuration Edit</h4>

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
                <form action="{{ url('admin/configuration/update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <ul class="conf-top">
                        @if ($globalSetting->app_logo)
                            <li>
                                <label for="Name">Previous App Logo</label>
                                <img src="{{ asset($globalSetting->app_logo) }}">
                            </li>
                        @endif
                        {{-- @if ($globalSetting->hero_image)
                        <li>
                            <label for="Name">Previous Hero Image</label>
                            <img src="{{ asset($globalSetting->hero_image) }}">
                        </li>
                    @endif --}}
                        @if ($globalSetting->section1_image)
                            <li>
                                <label for="Name">Previous Section1 Image</label>
                                <img src="{{ asset($globalSetting->section1_image) }}">
                            </li>
                        @endif
                        @if ($globalSetting->section2_image)
                            <li>
                                <label for="Name">Previous Section2 Image</label>
                                <img src="{{ asset($globalSetting->section2_image) }}">
                            </li>
                        @endif
                        @if ($globalSetting->section3_image)
                            <li>
                                <label for="Name">Previous Section3 Image</label>
                                <img src="{{ asset($globalSetting->section3_image) }}">
                            </li>
                        @endif
                        @if ($globalSetting->section2_icon1)
                            <li>
                                <label for="Name">Previous Section2 Icon1</label>
                                <img src="{{ asset($globalSetting->section2_icon1) }}">
                            </li>
                        @endif
                        @if ($globalSetting->section2_icon2)
                            <li>
                                <label for="Name">Previous Section2 Icon2</label>
                                <img src="{{ asset($globalSetting->section2_icon2) }}">
                            </li>
                        @endif
                        @if ($globalSetting->section2_icon3)
                            <li>
                                <label for="Name">Previous Section2 Icon3</label>
                                <img src="{{ asset($globalSetting->section2_icon3) }}">
                            </li>
                        @endif
                        @if ($globalSetting->section2_icon4)
                            <li>
                                <label for="Name">Previous Section2 Icon4</label>
                                <img src="{{ asset($globalSetting->section2_icon4) }}">
                            </li>
                        @endif
                    </ul>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">App Name</label>
                            <input type="text" class="form-control" name="app_name" id="name"
                                placeholder="Enter app name" value="{{ $globalSetting->app_name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">New App Logo</label>
                            <input type="file" class="form-control" name="app_logo" id="email"
                                placeholder="Enter app logo">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Name">Mobile</label>
                            <input type="text" class="form-control" name="mobile" id="name"
                                placeholder="Enter mobile" value="{{ $globalSetting->mobile }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Name">Email</label>
                            <input type="email" class="form-control" name="email" id="name"
                                placeholder="Enter email" value="{{ $globalSetting->email }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Name">Address</label>
                            <input type="text" class="form-control" name="address" id="name"
                                placeholder="Enter email" value="{{ $globalSetting->address }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name">Hero Title</label>
                            <input type="text" class="form-control" name="hero_title" id="name"
                                placeholder="Enter hero title" value="{{ $globalSetting->hero_title }}">
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="Name">New Hero Image</label>
                            <input type="file" class="form-control" name="hero_image" id="email"
                                placeholder="Enter app logo">
                        </div> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name">Hero Description</label>
                            <textarea id="editor2" type="text" class="form-control" name="hero_description" id="name"
                                placeholder="Enter hero description">{{ $globalSetting->hero_description }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Section1 Text</label>
                            <input type="text" class="form-control" name="section1_text" id="name"
                                placeholder="Enter section1 text" value="{{ $globalSetting->section1_text }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">New Section1 Image</label>
                            <input type="file" class="form-control" name="section1_image" id="email"
                                placeholder="Enter section1 image">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Section2 Heading</label>
                            <input type="text" class="form-control" name="section2_heading" id="name"
                                placeholder="Enter section2 heading" value="{{ $globalSetting->section2_heading }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">New Section2 Image</label>
                            <input type="file" class="form-control" name="section2_image" id="email"
                                placeholder="Enter section2 image">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">Section2 Image Link</label>
                            <input type="text" class="form-control" name="section2_image_link" id="name"
                                placeholder="Enter section2 image link"
                                value="{{ $globalSetting->section2_image_link }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Section2 Icon1 Text</label>
                            <input type="text" class="form-control" name="section2_icon1_text" id="name"
                                placeholder="Enter section2 icon1 text"
                                value="{{ $globalSetting->section2_icon1_text }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">New Section2 Icon1</label>
                            <input type="file" class="form-control" name="section2_icon1" id="email"
                                placeholder="Enter section2 icon1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name">Section2 Icon1 Details</label>
                            <input type="text" class="form-control" name="section2_icon1_details" id="name"
                                placeholder="Enter section2 icon1 details"
                                value="{{ $globalSetting->section2_icon1_details }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Section2 Icon2 Text</label>
                            <input type="text" class="form-control" name="section2_icon2_text" id="name"
                                placeholder="Enter section2 icon2 text"
                                value="{{ $globalSetting->section2_icon2_text }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">New Section2 Icon2</label>
                            <input type="file" class="form-control" name="section2_icon2" id="email"
                                placeholder="Enter section2 icon2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name">Section2 Icon2 Details</label>
                            <input type="text" class="form-control" name="section2_icon2_details" id="name"
                                placeholder="Enter section2 icon2 details"
                                value="{{ $globalSetting->section2_icon2_details }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Section2 Icon3 Text</label>
                            <input type="text" class="form-control" name="section2_icon3_text" id="name"
                                placeholder="Enter section2 icon3 text"
                                value="{{ $globalSetting->section2_icon3_text }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">New Section2 Icon3</label>
                            <input type="file" class="form-control" name="section2_icon3" id="email"
                                placeholder="Enter section2 icon3">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name">Section2 Icon3 Details</label>
                            <input type="text" class="form-control" name="section2_icon3_details" id="name"
                                placeholder="Enter section2 icon3 details"
                                value="{{ $globalSetting->section2_icon3_details }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Section2 Icon4 Text</label>
                            <input type="text" class="form-control" name="section2_icon4_text" id="name"
                                placeholder="Enter section2 icon3 text"
                                value="{{ $globalSetting->section2_icon3_text }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">New Section2 Icon4</label>
                            <input type="file" class="form-control" name="section2_icon4" id="email"
                                placeholder="Enter section2 icon4">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name">Section2 Icon4 Details</label>
                            <input type="text" class="form-control" name="section2_icon4_details" id="name"
                                placeholder="Enter section2 icon4 details"
                                value="{{ $globalSetting->section2_icon4_details }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Section3 Heading</label>
                            <input type="text" class="form-control" name="section3_heading" id="name"
                                placeholder="Enter section3 heading" value="{{ $globalSetting->section3_heading }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">New Section3 Image</label>
                            <input type="file" class="form-control" name="section3_image" id="email"
                                placeholder="Enter section3 image">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">Section3 Image Link</label>
                            <input type="text" class="form-control" name="section3_image_link" id="name"
                                placeholder="Enter section3 image link"
                                value="{{ $globalSetting->section3_image_link }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name">Section3 Description</label>
                            <textarea id="editor4" type="text" class="form-control" name="section3_description" id="name"
                                placeholder="Enter section3 description">{{ $globalSetting->section3_details }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Name">Section4 Text</label>
                            <input type="text" class="form-control" name="section4_text" id="name"
                                placeholder="Enter section4 text" value="{{ $globalSetting->section4_text }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Name">Section4 Button Text</label>
                            <input type="text" class="form-control" name="section4_button_text" id="name"
                                placeholder="Enter section4 button text"
                                value="{{ $globalSetting->section4_button_text }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Name">Section4 Button Url</label>
                            <input type="text" class="form-control" name="section4_button_url" id="name"
                                placeholder="Enter section4 button url"
                                value="{{ $globalSetting->section4_button_url }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name">Section4 Description</label>
                            <textarea id="editor5" type="text" class="form-control" name="section4_description" id="name"
                                placeholder="Enter section4 description">{{ $globalSetting->section4_details }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Name">Faccbook Link</label>
                            <input type="text" class="form-control" name="facebook_link" id="name"
                                placeholder="Enter facebook link" value="{{ $globalSetting->facebook_link }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Name">Instagram Link</label>
                            <input type="text" class="form-control" name="instagram_link" id="name"
                                placeholder="Enter instagram link" value="{{ $globalSetting->instagram_link }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Name">Twitter Link</label>
                            <input type="text" class="form-control" name="twitter_link" id="name"
                                placeholder="Enter twitter link" value="{{ $globalSetting->twitter_link }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Terms and Condition</label>
                            <textarea id="editor1" type="text" class="form-control" name="terms_and_condition" id="name"
                                placeholder="Enter terms and condition">{{ $globalSetting->terms_and_condition }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name">Privacy Poliacy</label>
                            <textarea id="editor3" type="text" class="form-control" name="privacy_policy" id="name"
                                placeholder="Enter privacy policy">{{ $globalSetting->privacy_policy }}</textarea>
                        </div>
                    </div>

                    <button type="submit" id="add_btn" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>


    </div>
 
{{-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.editorConfig = function(config) {
        // Disable version check
        config.versionCheck = false;
    };

    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor instance
        CKEDITOR.replace('editor1');
        // Replace the <textarea id="editor2"> with another CKEditor instance
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
        CKEDITOR.replace('editor5');
        CKEDITOR.replace('editor6');
        CKEDITOR.replace('editor7');
        CKEDITOR.replace('editor8');
        CKEDITOR.replace('editor9');
        CKEDITOR.replace('editor10');
        
        // Bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script> --}}

<script src="https://cdn.tiny.cloud/1/59sp4a7vac944p04i9qpgiy90qx9ztls00hi5ogjxoimmy66/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: '#editor1, #editor2, #editor3, #editor4, #editor5, #editor6, #editor7, #editor8, #editor9, #editor10'
        });
    });
</script>


@endsection
