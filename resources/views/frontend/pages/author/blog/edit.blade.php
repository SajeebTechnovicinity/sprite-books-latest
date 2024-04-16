
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
       <textarea id="editor1" class="textarea" name="blog_full_description" placeholder="Enter some text here"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$blog->blog_full_description}}</textarea>
</div>

<div class="form-field">
    <label for="title" class="label">Blog Image (Max 512 KB) (Recommanded: 300x300 px)*</label>
    <input type="file" name="blog_image" id="title" class="input" />
    <label style="display: block; font-weight: 600; font-size: 16px; margin: 15px 0 10px;">Current Image</label>
    <img src="{{asset($blog->blog_image)}}">
</div>


