<!DOCTYPE html>
<html>
<head>
    <!-- Your head content goes here -->
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" />
    <div class="form-field">
        <label for="title" class="label">Blog Title*</label>
        <input type="text" name="blog_name" id="title" value="{{ $blog->blog_name }}" class="input" />
        <input type="hidden" name="blog_id" id="title" value="{{ $blog->id }}" class="input" />
    </div>

    <div class="form-field">
        <label for="title" class="label">Blog short Description*</label>
        <textarea name="blog_short_description" class="input">{{ $blog->blog_short_description }}</textarea>
    </div>

    <div class="form-field">
        <label for="title" class="label">Blog Description*</label>
        <textarea id="editor2" class="textarea" name="blog_full_description" placeholder="Enter some text here"
            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $blog->blog_full_description }}</textarea>
    </div>

    <div class="form-field">
        <label for="title" class="label">Blog Image (Max 512 KB) (Recommanded: 300x300 px)*</label>
        <input type="file" name="blog_image" id="title" class="input" />
        <label style="display: block; font-weight: 600; font-size: 16px; margin: 15px 0 10px;">Current Image</label>
        <img src="{{ asset($blog->blog_image) }}">
    </div>

    <div class="form-field">
        <label for="title" class="label">Meta Title*</label>
        <input type="text" name="meta_title" id="title" class="input" value="{{ $blog->meta_title }}" required />
    </div>

    <div class="form-field">
        <label for="title" class="label">Meta Description*</label>
        <input type="text" name="meta_description" id="title" class="input" value="{{ $blog->meta_description }}" required />
    </div>

    <div class="form-field">
        <label for="title" class="label">Meta Keyword*</label>
        <input type="text" name="meta_keyword" id="title" class="input" value="{{ $blog->meta_keyword }}" required />
    </div>

    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- CKEditor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
    <script>
        $(function() {
            $('#editor2').summernote({
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
      });

    </script>

</body>
</html>
