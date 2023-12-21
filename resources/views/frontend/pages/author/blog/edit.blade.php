
<div class="form-field">
    <label for="title" class="label">Blog Title*</label>
    <input type="text" name="blog_name" id="title" value="{{$blog->blog_name}}" class="input" />
    <input type="hidden" name="blog_id" id="title" value="{{$blog->id}}" class="input" />
</div>


<div class="form-field">
    <label for="title" class="label">Blog short Description*</label>
    <textarea name="blog_short_description" class="input">{{$blog->blog_short_description}}</textarea>
</div>

<div class="form-field">
    <label for="title" class="label">Blog Description*</label>
    <textarea name="blog_full_description" class="input">{{$blog->blog_full_description}}</textarea>
</div>

<div class="form-field">
    <label for="title" class="label">Blog Image*</label>
    <input type="file" name="blog_image" id="title" class="input" />
    <hr>
    Current Image
    <img src="{{asset($blog->blog_image)}}">
</div>
