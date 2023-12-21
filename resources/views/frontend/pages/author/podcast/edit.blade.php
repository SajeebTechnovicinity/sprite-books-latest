               
                <div class="form-field">
                    <label for="title" class="label">Podcast Name*</label>
                    <input type="text" name="podcast_name" id="title" value="{{$podcast->podcast_name}}" class="input" />
                    <input type="hidden" name="podcast_id" id="title" value="{{$podcast->id}}" class="input" />
                </div>

                <div class="form-field">
                    <label for="title" class="label">Podcast embed Code*</label>
                    <textarea name="podcast_embed_code" class="input">{!!$podcast->podcast_embed_code!!}</textarea>
                    <hr>
Current Podcast : 
                  <div style="max-width: 100%">  {!!$podcast->podcast_embed_code!!}
                  </div>
                </div>