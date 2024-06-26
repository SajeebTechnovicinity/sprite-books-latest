              @if (session('type') == 'PUBLISHER')
                  <div class="form-field">
                      <label for="text-area">Author </label>
                      <select name="event_author" id="event_author" class="input">
                          @foreach ($author_created_list as $listA)
                              <option value="{{ $listA->id }}">{{ $listA->author_name }}</option>
                          @endforeach
                      </select>
                  </div>
              @endif

              <div class="form-field">
                  <label for="title" class="label">Event Name*</label>
                  <input type="text" name="event_name" id="title" value="{{ $event->event_name }}"
                      class="input" />
                  <input type="hidden" name="event_id" id="title" value="{{ $event->id }}" class="input" />
              </div>

              <div class="form-field">
                  <label for="dsc" class="label">Event Description*</label>
                  <textarea name="event_description" id="dsc" class="textarea">{{ $event->event_description }}</textarea>
              </div>

              <div class="form-row">
                  <div class="form-field">
                      <label class="label">Event Location*</label>
                      <input type="text" name="event_location" class="input" placeholder="Location"
                          value="{{ $event->event_location }}" />
                  </div>
              </div>

              <div class="form-row">
                  <div class="form-field">
                      <label class="label">Event Date*</label>
                      <input type="date" name="event_date" class="input" placeholder="Date"
                          value="{{ $event->event_date }}" />
                  </div>
              </div>

              <div class="form-row">
                  <div class="form-field">
                      <label class="label">Event Link</label>
                      <input type="text" name="event_link" class="input" value="{{ $event->event_link }}"
                          placeholder="Link" />
                  </div>
              </div>

              <div class="form-row">
                  <div class="form-field">
                      <label class="label">Meta Title</label>
                      <input type="text" name="meta_title" value="{{ $event->meta_title }}" class="input" placeholder="Meta Title" />
                  </div>
              </div>

              <div class="form-row">
                  <div class="form-field">
                      <label class="label">Meta Description</label>
                      <input type="text" name="meta_description" class="input" value="{{ $event->meta_description }}" placeholder="Meta Description" />
                  </div>
              </div>

              <div class="form-row">
                  <div class="form-field">
                      <label class="label">Meta Keyword</label>
                      <input type="text" name="meta_keyword" class="input" value="{{ $event->meta_keyword }}" placeholder="Meta Keyword" />
                  </div>
              </div>



              <div class="form-row">
                  <div class="form-field">
                      <label class="label">Time Start & Ending*</label>
                      <input type="time" name="event_starting_time" class="input" placeholder="Time start"
                          value="{{ $event->event_starting_time }}" />
                  </div>
                  <div class="form-field">
                      <input type="time" name="event_ending_time" class="input" placeholder="Time End"
                          value="{{ $event->event_ending_time }}" />
                  </div>
              </div>

              <div class="form-field">
                  <label for="attach-file5" class="attach-btn btn-lite btn button-hint">
                      <span class="icon">
                          <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                  fill="black" />
                          </svg>
                      </span>
                      <span class="text">
                          Change Image(Max 512 KB)
                          <span class="inner">(Recommanded: 400x600 px)</span>
                      </span>
                  </label>

                  <input class="attach-input" type="file" name="image" id="attach-file5" accept="image/*" />
              </div>
