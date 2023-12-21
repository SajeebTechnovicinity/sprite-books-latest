              
              
@if(session('type') == 'PUBLISHER')
             <div class="form-field">
                <label for="text-area">Author </label>
                <select name="event_author" id="event_author" class="input">
                  @foreach ($author_created_list as $listA)      
                    <option value="{{$listA->id}}">{{$listA->author_name}}</option>
                    @endforeach
                </select>
              </div>
@endif

                <div class="form-field">
                    <label for="title" class="label">Event Name*</label>
                    <input type="text" name="event_name" id="title" value="{{$event->event_name}}" class="input" />
                    <input type="hidden" name="event_id" id="title" value="{{$event->id}}" class="input" />
                </div>

                <div class="form-field">
                    <label for="dsc" class="label">Event Description*</label>
                    <textarea name="event_description" id="dsc" class="textarea">{{$event->event_description}}</textarea>
                </div>

                     <div class="form-row">
                    <div class="form-field">
                        <label class="label">Event Location*</label>
                        <input type="text" name="event_location" class="input" placeholder="Location" value="{{$event->event_location}}"/>
                    </div>                    
                </div>
           
                <div class="form-row">
                    <div class="form-field">
                        <label class="label">Event Date*</label>
                        <input type="date" name="event_date" class="input" placeholder="Date" value="{{$event->event_date}}"/>
                    </div>                    
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="label">Event Link</label>
                        <input type="text" name="event_link" class="input" value="{{$event->event_link}}" placeholder="Link" />
                    </div>                    
                </div>


                     <div class="form-row">
                    <div class="form-field">
                        <label class="label">Time Start & Ending*</label>
                        <input type="time" name="event_starting_time" class="input" placeholder="Time start" value="{{$event->event_starting_time}}"/>
                    </div>
                    <div class="form-field">
                        <input type="time" name="event_ending_time" class="input" placeholder="Time End" value="{{$event->event_ending_time}}"/>
                    </div>
                </div>