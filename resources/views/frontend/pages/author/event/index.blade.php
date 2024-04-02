@extends('master')

@section('content')
    <!-- Add Book Modal -->
    <div class="add-book-modal modal d-none" id="add-book">
        <div class="modal__wrap">
            <div class="modal__inner">
                <div class="modal__close">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.42191 14.5725C1.05416 14.5936 0.692485 14.4734 0.413161 14.2372C-0.13772 13.6923 -0.13772 12.8122 0.413161 12.2673L12.4757 0.405807C13.0486 -0.1214 13.9477 -0.0920931 14.4838 0.471323C14.9687 0.980817 14.9969 1.76392 14.55 2.3059L2.41643 14.2372C2.14071 14.4699 1.78484 14.5899 1.42191 14.5725Z"
                            fill="#8D8D9B" />
                        <path
                            d="M13.4702 14.5726C13.0975 14.571 12.7403 14.4255 12.4757 14.1674L0.413108 2.30588C-0.0972546 1.71983 -0.0278681 0.837855 0.568117 0.335952C1.10005 -0.111984 1.88454 -0.111984 2.41643 0.335952L14.55 12.1975C15.1228 12.7248 15.1524 13.6089 14.6162 14.1722C14.5948 14.1946 14.5728 14.2163 14.55 14.2373C14.2529 14.4913 13.8619 14.6127 13.4702 14.5726Z"
                            fill="#8D8D9B" />
                    </svg>
                </div>
                <h3 class="title">Add your Book</h3>
                <form action="{{ url('author/add-books') }}" method="post" class="modal__form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="invalid-isbn" id="invalid-isbn" display="none"></div>
                    <div class="form-field">
                        <label for="isbn" class="label">ISBN*</label>
                        <div class="has-loader">
                            <span class="loader" style="display: none;"></span>
                            <input type="text" name="isbn" id="#isbn" class="input" onblur="handleInput()"
                                required />
                        </div>
                    </div>

                    <input type="hidden" name="file_updoad_isbn" id="file_updoad_isbn" required />

                    <div class="form-field">
                        <label for="title" class="label">Book Title*</label>
                        <input type="text" name="book_name" id="title" class="input" required />
                    </div>

                    <div class="form-field">
                        <label for="dsc" class="label">Book Description*</label>
                        <textarea name="book_description" id="dsc" class="textarea" required></textarea>
                    </div>

                    <div class="form-field">
                        <label for="dsc" class="label">Select Genre*</label>
                        <select class="input form-control" name="genere_id" required>
                            @foreach ($generes as $row)
                                <option value="{{ $row->id }}">{{ $row->genere_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="links" class="label">Book Amazon Links</label>
                            <input type="text" name="book_amazon_link" id="links" class="input" />
                        </div>

                    </div>


                    <div class="form-row">
                        <div class="form-field">
                            <label for="links" class="label">Book Ebay Links</label>
                            <input type="text" name="book_ebay_link" id="links" class="input" />
                        </div>
                        {{-- <div class="add">
                      <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#clip0_954_2055)">
                              <path
                                  d="M22.7679 10.2679H15.1786C14.932 10.2679 14.7321 10.068 14.7321 9.82143V2.23214C14.7321 0.999451 13.7327 0 12.5 0C11.2673 0 10.2679 0.999451 10.2679 2.23214V9.82143C10.2679 10.068 10.068 10.2679 9.82143 10.2679H2.23214C0.999451 10.2679 0 11.2673 0 12.5C0 13.7327 0.999451 14.7321 2.23214 14.7321H9.82143C10.068 14.7321 10.2679 14.932 10.2679 15.1786V22.7679C10.2679 24.0005 11.2673 25 12.5 25C13.7327 25 14.7321 24.0005 14.7321 22.7679V15.1786C14.7321 14.932 14.932 14.7321 15.1786 14.7321H22.7679C24.0005 14.7321 25 13.7327 25 12.5C25 11.2673 24.0005 10.2679 22.7679 10.2679Z"
                                  fill="#8D8D9B" />
                          </g>
                          <defs>
                              <clipPath id="clip0_954_2055">
                                  <rect width="25" height="25" fill="white" />
                              </clipPath>
                          </defs>
                      </svg>
                  </div> --}}
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label class="label">Book Discount in Percentage</label>
                            <input type="number" name="book_discount_in_percentage" class="input" placeholder="" />
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label class="label">Main Price to Show*</label>
                            <input type="number" name="book_price" class="input" placeholder="Price" required />
                        </div>

                        <div class="form-field">
                            <label class="label">Book Price</label>
                            <input type="number" name="hard_book_price" class="input" placeholder="HardBook" />
                        </div>
                        <div class="form-field">
                            <input type="number" name="ebook_price" class="input" placeholder="Ebook" />
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="attach-file" class="attach-btn btn-lite btn button-hint">
                            <span class="icon">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <span class="text">
                                Attach File(Max 512 KB)*
                                <span class="inner">(Recommanded: 400x600 px)</span>
                            </span>
                        </label>

                        <input class="attach-input" type="file" name="file_updoad" id="attach-file" accept="image/*"
                            required />
                    </div>

                    {{-- <div class="form-field">
                        <label for="attach-file1" class="attach-btn1 btn-lite btn">
                            <span class="icon">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                        fill="black" />
                                </svg>
                            </span>
                            Attach Video (Max: 5 MB)
                        </label>
                        <input class="attach-input" type="file" name="video_file_updoad" id="attach-file1"
                            accept="video/*"  />
                    </div> --}}

                    <div class="form-row">
                        <div class="form-field">
                            <label for="links" class="label">Video Link</label>
                            <input type="text" name="video_file_updoad" id="links" class="input" />
                        </div>

                    </div>

                    <div class="btn-group">
                        <button class="btn btn-lite">Cancel</button>
                        <button class="btn btn-solid">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Add Event Modal -->
    <div class="aadd-event-modal modal d-none" id="add-event">
        <div class="modal__inner">
            <div class="modal__close">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.42191 14.5725C1.05416 14.5936 0.692485 14.4734 0.413161 14.2372C-0.13772 13.6923 -0.13772 12.8122 0.413161 12.2673L12.4757 0.405807C13.0486 -0.1214 13.9477 -0.0920931 14.4838 0.471323C14.9687 0.980817 14.9969 1.76392 14.55 2.3059L2.41643 14.2372C2.14071 14.4699 1.78484 14.5899 1.42191 14.5725Z"
                        fill="#8D8D9B" />
                    <path
                        d="M13.4702 14.5726C13.0975 14.571 12.7403 14.4255 12.4757 14.1674L0.413108 2.30588C-0.0972546 1.71983 -0.0278681 0.837855 0.568117 0.335952C1.10005 -0.111984 1.88454 -0.111984 2.41643 0.335952L14.55 12.1975C15.1228 12.7248 15.1524 13.6089 14.6162 14.1722C14.5948 14.1946 14.5728 14.2163 14.55 14.2373C14.2529 14.4913 13.8619 14.6127 13.4702 14.5726Z"
                        fill="#8D8D9B" />
                </svg>
            </div>
            <h3 class="title">Add Event</h3>
            <form action="{{ url('author/add-event') }}" method="post" class="modal__form"
                enctype="multipart/form-data">
                @csrf
                @method('post')

                {{--  <div class="form-field">
                    <label for="text-area">Author </label>
                    <select name="event_author" id="event_author" class="input">
                        @foreach ($author_created_list as $listA)
                            <option value="{{ $listA->id }}">{{ $listA->author_name }}</option>
                        @endforeach
                    </select>
                </div>  --}}

                <div class="form-field">
                    <label for="title" class="label">Event Name*</label>
                    <input type="text" name="event_name" id="title" class="input" />
                </div>

                <div class="form-field">
                    <label for="dsc" class="label">Event Description*</label>
                    <textarea name="event_description" id="dsc" class="textarea"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="label">Event Location*</label>
                        <input type="text" name="event_location" class="input" placeholder="Location" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="label">Event Date*</label>
                        <input type="date" name="event_date" class="input" placeholder="Date" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="label">Event Link</label>
                        <input type="text" name="event_link" class="input" placeholder="Link" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="label">Time Start & Ending*</label>
                        <input type="time" name="event_starting_time" class="input" placeholder="Time start" />
                    </div>
                    <div class="form-field">
                        <input type="time" name="event_ending_time" class="input" placeholder="Time End" />
                    </div>
                </div>



                <div class="btn-group">
                    <button class="btn btn-lite">Cancel</button>
                    <button class="btn btn-solid">Add Event</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit Event Modal -->
    <div class="edit-event-modal modal d-none" id="edit-event">
        <div class="modal__inner">
            <div class="modal__close">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.42191 14.5725C1.05416 14.5936 0.692485 14.4734 0.413161 14.2372C-0.13772 13.6923 -0.13772 12.8122 0.413161 12.2673L12.4757 0.405807C13.0486 -0.1214 13.9477 -0.0920931 14.4838 0.471323C14.9687 0.980817 14.9969 1.76392 14.55 2.3059L2.41643 14.2372C2.14071 14.4699 1.78484 14.5899 1.42191 14.5725Z"
                        fill="#8D8D9B" />
                    <path
                        d="M13.4702 14.5726C13.0975 14.571 12.7403 14.4255 12.4757 14.1674L0.413108 2.30588C-0.0972546 1.71983 -0.0278681 0.837855 0.568117 0.335952C1.10005 -0.111984 1.88454 -0.111984 2.41643 0.335952L14.55 12.1975C15.1228 12.7248 15.1524 13.6089 14.6162 14.1722C14.5948 14.1946 14.5728 14.2163 14.55 14.2373C14.2529 14.4913 13.8619 14.6127 13.4702 14.5726Z"
                        fill="#8D8D9B" />
                </svg>
            </div>
            <h3 class="title">Edit Event</h3>
            <form action="{{ url('author/update-event') }}" method="post" class="modal__form"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div id="editEventInputs"></div>


                <div class="btn-group">
                    <button class="btn btn-lite">Cancel</button>
                    <button class="btn btn-solid">Update Event</button>
                </div>
            </form>
        </div>
    </div>




    <!-- Content Block -->
    <section class="body-content">
        <div class="container">
            <div class="inner-content">
                <div class="tab-panel">
                    @if (check_user_max_book_by_user_id(session('author_id')) == '1')
                        <button class="add-btn btn-solid btn-trigger" data-target="#add-book">
                            <span class="icon">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2952_633)">
                                        <path
                                            d="M16.3929 7.39286H10.9286C10.7511 7.39286 10.6071 7.24894 10.6071 7.07143V1.60714C10.6071 0.719604 9.88754 0 9 0C8.11246 0 7.39286 0.719604 7.39286 1.60714V7.07143C7.39286 7.24894 7.24894 7.39286 7.07143 7.39286H1.60714C0.719604 7.39286 0 8.11246 0 9C0 9.88754 0.719604 10.6071 1.60714 10.6071H7.07143C7.24894 10.6071 7.39286 10.7511 7.39286 10.9286V16.3929C7.39286 17.2804 8.11246 18 9 18C9.88754 18 10.6071 17.2804 10.6071 16.3929V10.9286C10.6071 10.7511 10.7511 10.6071 10.9286 10.6071H16.3929C17.2804 10.6071 18 9.88754 18 9C18 8.11246 17.2804 7.39286 16.3929 7.39286Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2952_633">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            Add a Book
                        </button>
                    @else
                        <button class="add-btn btn-solid"
                            onclick="alert('You have crossed the limit of your current membership plan!')">
                            <span class="icon">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2952_633)">
                                        <path
                                            d="M16.3929 7.39286H10.9286C10.7511 7.39286 10.6071 7.24894 10.6071 7.07143V1.60714C10.6071 0.719604 9.88754 0 9 0C8.11246 0 7.39286 0.719604 7.39286 1.60714V7.07143C7.39286 7.24894 7.24894 7.39286 7.07143 7.39286H1.60714C0.719604 7.39286 0 8.11246 0 9C0 9.88754 0.719604 10.6071 1.60714 10.6071H7.07143C7.24894 10.6071 7.39286 10.7511 7.39286 10.9286V16.3929C7.39286 17.2804 8.11246 18 9 18C9.88754 18 10.6071 17.2804 10.6071 16.3929V10.9286C10.6071 10.7511 10.7511 10.6071 10.9286 10.6071H16.3929C17.2804 10.6071 18 9.88754 18 9C18 8.11246 17.2804 7.39286 16.3929 7.39286Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2952_633">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            Add a Book
                        </button>
                    @endif
                    <nav>
                        @include('layouts.frontend.author_sidebar')
                    </nav>
                </div>
                <div class="tab-content">




                    <div class="tab-body__inner" id="events">
                        @if (count($events))
                            @foreach ($events as $row)
                                <div class="event-card">
                                    <figure class="figure">
                                        <img style="height: 60px;width:60px"
                                            src="@if ($row->Author->author_profile_picture) {{ asset($row->Author->author_profile_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile.jpg @endif"
                                            alt="" />
                                    </figure>
                                    <div class="content" style="width:50%">
                                        <div class="event-card__row flex-wrap">
                                            <h3 class="event-card__title">
                                                {{ $row->event_name }}
                                            </h3>
                                            <a href="#." class="icon btn-trigger btn"
                                                onclick="editEvent({{ $row->id }})">
                                                <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M16.5312 20.8438C16.1345 20.8438 15.8125 20.5217 15.8125 20.125C15.8125 19.7283 16.1345 19.4062 16.5312 19.4062H16.532C16.532 19.0095 16.8532 18.6875 17.2504 18.6875C17.6475 18.6875 17.9688 19.0095 17.9688 19.4062C17.9688 20.199 17.324 20.8438 16.5312 20.8438Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M17.25 20.1248C16.8532 20.1248 16.5312 19.8028 16.5312 19.4061V12.3569C16.5312 11.9602 16.8532 11.6382 17.25 11.6382C17.6467 11.6382 17.9688 11.9602 17.9688 12.3569V19.4061C17.9688 19.8028 17.6467 20.1248 17.25 20.1248Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M16.5312 20.8438H3.59375C3.197 20.8438 2.875 20.5217 2.875 20.125C2.875 19.7282 3.197 19.4062 3.59375 19.4062H16.5312C16.928 19.4062 17.25 19.7282 17.25 20.125C17.25 20.5217 16.928 20.8438 16.5312 20.8438Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M3.59375 20.8438C2.80097 20.8438 2.15625 20.199 2.15625 19.4062C2.15625 19.0095 2.47825 18.6875 2.875 18.6875C3.27175 18.6875 3.59375 19.0095 3.59375 19.4062V19.4073C3.9905 19.4073 4.3125 19.7286 4.3125 20.1254C4.3125 20.5221 3.9905 20.8438 3.59375 20.8438Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M2.875 20.125C2.47825 20.125 2.15625 19.803 2.15625 19.4062V6.46875C2.15625 6.072 2.47825 5.75 2.875 5.75C3.27175 5.75 3.59375 6.072 3.59375 6.46875V19.4062C3.59375 19.803 3.27175 20.125 2.875 20.125Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M2.87464 7.1875C2.47753 7.1875 2.15625 6.8655 2.15625 6.46875C2.15625 5.67597 2.80097 5.03125 3.59375 5.03125C3.9905 5.03125 4.3125 5.35325 4.3125 5.75C4.3125 6.14675 3.9905 6.46875 3.59375 6.46875H3.59303C3.59303 6.8655 3.27175 7.1875 2.87464 7.1875Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M10.6429 6.46875H3.59375C3.197 6.46875 2.875 6.14675 2.875 5.75C2.875 5.35325 3.197 5.03125 3.59375 5.03125H10.6429C11.0396 5.03125 11.3616 5.35325 11.3616 5.75C11.3616 6.14675 11.04 6.46875 10.6429 6.46875Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M10.0375 11.1402C9.85351 11.1402 9.66951 11.0701 9.52935 10.9296C9.24868 10.6489 9.24868 10.194 9.52935 9.91328L16.549 2.89361C16.8293 2.61294 17.285 2.61294 17.5653 2.89361C17.846 3.17428 17.846 3.62925 17.5653 3.90992L10.5457 10.9296C10.4055 11.0701 10.2211 11.1402 10.0375 11.1402Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M9.34447 14.3747C9.29452 14.3747 9.24384 14.3697 9.19317 14.3585C8.80505 14.2755 8.5578 13.8931 8.64117 13.5054L9.33513 10.2703C9.41814 9.88179 9.80124 9.63346 10.1886 9.71828C10.5768 9.80129 10.824 10.1837 10.7406 10.5714L10.0467 13.8065C9.97409 14.144 9.67617 14.3747 9.34447 14.3747Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M12.579 13.6807C12.395 13.6807 12.211 13.6106 12.0709 13.4701C11.7902 13.1894 11.7902 12.7345 12.0709 12.4538L19.0905 5.43414C19.3708 5.15346 19.8265 5.15346 20.1068 5.43414C20.3875 5.71481 20.3875 6.16978 20.1068 6.45045L13.0872 13.4701C12.947 13.6106 12.763 13.6807 12.579 13.6807Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M9.34328 14.3752C9.01158 14.3752 8.71366 14.1444 8.64106 13.8073C8.55805 13.4192 8.80494 13.0368 9.19307 12.9538L12.4282 12.2595C12.8152 12.1772 13.1983 12.423 13.2817 12.8112C13.3647 13.1993 13.1178 13.5817 12.7297 13.6647L9.49458 14.359C9.44391 14.3698 9.39324 14.3752 9.34328 14.3752Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M18.3282 7.93168C18.1442 7.93168 17.9602 7.8616 17.82 7.72108L15.2789 5.17994C14.9982 4.89927 14.9982 4.4443 15.2789 4.16363C15.5592 3.88296 16.0149 3.88296 16.2952 4.16363L18.8363 6.70477C19.117 6.98544 19.117 7.44041 18.8363 7.72108C18.6962 7.8616 18.5122 7.93168 18.3282 7.93168Z"
                                                        fill="#8D8D9B" />
                                                    <path
                                                        d="M19.5984 6.66103C19.4144 6.66103 19.2304 6.59095 19.0899 6.45043C18.8092 6.16976 18.8092 5.71443 19.0899 5.43376C19.289 5.23503 19.3986 4.96406 19.3986 4.67188C19.3986 4.37971 19.289 4.10874 19.0899 3.91001C18.691 3.51074 17.9633 3.5111 17.5651 3.90965C17.2844 4.19032 16.8294 4.19032 16.5484 3.91001C16.2677 3.62934 16.2677 3.17401 16.5484 2.89334C17.0192 2.4222 17.651 2.16309 18.3273 2.16309C19.0036 2.16309 19.6358 2.42255 20.1062 2.89334C20.5766 3.36376 20.8357 3.99518 20.8357 4.67188C20.8357 5.34859 20.5766 5.98037 20.1058 6.45079C19.9664 6.59095 19.7824 6.66103 19.5984 6.66103Z"
                                                        fill="#8D8D9B" />
                                                </svg>
                                            </a>
                                        </div>
                                        <p class="event-card__timezone flex-wrap">
                                            {{ $row->event_date }}<span class="center">{{ $row->event_starting_time }}-
                                                {{ $row->event_ending_time }}
                                            </span><span>{{ $row->event_location }}</span>
                                        </p>
                                         @if (strlen($row->event_description) < 100)
                                            {{ $row->event_description }}
                                        @endif
                                        <?php
                                        $text = $row->event_description;
                                        if (strlen($text) > 100) {
                                            $firstPara = substr($text, 0, strpos($text, ' ', 30));
                                            $countLength = strlen($firstPara);
                                            $secondPara = substr($text, strpos($text, true) + $countLength);
                                        } else {
                                            $firstPara = $row->book_description ?? '';
                                        }
                                        ?>
                                        <p class="para">
                                            <span class="main">
                                                {{ $firstPara ?? '' }}
                                            </span>
                                            @if (strlen($text) > 100)
                                                <span class="extended" data-index="{{ $row->id }}"
                                                    style="display: none;">
                                                    {{ $secondPara }}
                                                    <br>
                                                    <b> Event Location : </b> {{ $row->event_location }}
                                                </span>
                                                <span class="read-more" data-index="{{ $row->id }}">Show More</span>
                                            @endif

                                        </p>

                                        <p class="para">
                                            <a href="{{ $row->event_link }}" target="__blank">Join Link</a>
                                        </p>
                                    </div>
                                    {{-- @endforeach --}}


                                </div>
                            @endforeach
                        @else
                            <p>No event created yet. Please create the first event.</p>
                        @endif
                        @if (check_user_max_event_by_user_id(session('author_id')) == '1')
                            <a href="#" class="add-event-btn btn-trigger" data-target="#add-event">Add
                                Event</a>
                        @else
                            <a href="#" class="add-event-btn"
                                onclick="alert('You have crossed the limit of your current membership plan!')">Add
                                Event</a>
                        @endif
                        {{-- <a href="#" class="add-event-btn btn-trigger" data-target="#add-event">Add
                        Event</a> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        function editEvent(id) {
            showCalimaticLoader();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('authors-get-event') }}",
                data: {
                    id: id
                },
                success: function(data, textStatus, jqXHR) {
                    $('#editEventInputs').html(data);
                    $('#edit-event').removeClass('d-none');
                    $('#edit-event').modal('toggle');
                    $(".success_msg").html("Data Save Successfully");
                    $(".success_msg").show();
                }
            }).fail(function(data, textStatus, jqXHR) {
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    //                console.log(key);
                    $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" +
                        value + "</span>");
                });
            });
            HideCalimaticLoader();


        }


        var typingTimer; //timer identifier
        var doneTypingInterval = 500; //time in ms (5 seconds)

        //on input change, start the countdown

        $('#isbn').on("input", function() {
            //showCalimaticLoader();
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                $.getJSON('https://openlibrary.org/books/OL7353617M.json', function(data) {
                    HideCalimaticLoader();
                    $('#isbn_10').val(data.isbn_10);
                    $('#isbn_13').val(data.isbn_13);
                    // console.log(data.isbn_10);
                    // $(".mypanel").text(JSON. stringify(data) );
                });
            }, doneTypingInterval);
        });
    </script>

    <script>
        function handleInput() {
            // Your JavaScript logic goes here
            // Get the ISBN value from the input field
            var isbn = document.getElementById("#isbn").value;

            console.log(isbn);
            $("#invalid-isbn").empty();
            // showCalimaticLoader();
            $('.has-loader .loader').css('display', 'block');

            // Make an API call
            var apiUrl = "https://api2.isbndb.com/book/" + isbn;

            $.ajax({
                url: apiUrl,
                type: "GET",
                headers: {
                    'Authorization': '51099_4d7a81aeab0d75869e85e1ea60561a9b',
                    'User-Agent': 'insomnia/5.12.4',
                    'Accept': '*/*'
                },
                success: function(response) {
                    // Request was successful, process the response
                    console.log(response);
                    // HideCalimaticLoader();
                    $('.has-loader .loader').css('display', 'none');
                    $('#title').val(response.book.title);
                    $('#dsc').val(response.book.synopsis);
                    $('#file_updoad_isbn').val(response.book.image);
                    // Process the bookData here
                },
                error: function(xhr) {
                    if (xhr.status == 404) {
                        // Not Found error
                        console.log("Error: Not Found");
                        $("#invalid-isbn").text("Invalid Isbn").css({
                            'color': 'red',
                            'display': 'block'
                        });
                        // HideCalimaticLoader();
                        $('.has-loader .loader').css('display', 'none');
                    } else if (xhr.status == 429) {
                        // Too Many Requests error
                        console.log("Error: Limit Exceeded");
                        $("#invalid-isbn").text("Limit Exceeded").css({
                            'color': 'red',
                            'display': 'block'
                        });;
                        // HideCalimaticLoader();
                        $('.has-loader .loader').css('display', 'none');
                    } else {
                        // Handle other status codes
                        console.log("Error: Unexpected status code " + xhr.status);
                        $("#invalid-isbn").text("Network error").css({
                            'color': 'red',
                            'display': 'block'
                        });;
                        // HideCalimaticLoader();
                        $('.has-loader .loader').css('display', 'none');
                    }
                },

            });

        }
    </script>
    <script>
        // Wait for the document to be ready
        document.addEventListener("DOMContentLoaded", function() {
            // Get all elements with the class "read-more"
            var readMoreButtons = document.querySelectorAll('.read-more');

            // Add click event listeners to all "Show More" buttons
            readMoreButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the index from the data-index attribute
                    var index = button.dataset.index;
                    // Find the corresponding extended content using the index
                    var extendedContent = document.querySelector('.extended[data-index="' + index +
                        '"]');

                    // Toggle the display of the extended content
                    if (extendedContent.style.display === 'none') {
                        extendedContent.style.display = 'inline'; // Show the extended content
                        button.textContent = 'Show Less'; // Change the button text
                    } else {
                        extendedContent.style.display = 'none'; // Hide the extended content
                        button.textContent = 'Show More'; // Change the button text back
                    }
                });
            });
        });
    </script>


@endsection
