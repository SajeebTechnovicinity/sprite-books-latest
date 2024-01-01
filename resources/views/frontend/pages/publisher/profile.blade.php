@extends('master')

@section('content')
    <!-- Add Book Modal -->
    <style>
        .hidden {
            display: none;
        }
    </style>
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
                    <div class="form-field">
                        <label for="isbn" class="label">Role*</label>
                        @if (check_user_max_book_by_user_id(session('author_id')) == 1)
                            <label><input type="radio" value="Publisher" name="author_define" required> Publisher</label>
                        @else
                            <label><input type="radio" value="Publisher" name="author_define" onclick="showAlert(this)"
                                    required> Publisher</label>
                        @endif
                        <label><input type="radio" value="Author" name="author_define" required> Author</label>
                    </div>
                    <div class="form-field">
                        <label for="text-area" id="author_text">Author </label>
                        <select name="book_author" id="book_author" class="input">
                            @foreach ($author_created_list as $listA)
                                <option value="{{ $listA->id }}">{{ $listA->author_name }}</option>
                            @endforeach
                        </select>
                    </div>

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
                        <label for="attach-file" class="attach-btn btn-lite btn">
                            <span class="icon">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                        fill="black" />
                                </svg>
                            </span>
                            Attach File (Max 512 KB)*
                        </label>
                        (Recommanded: 400x600 px)
                        <input class="attach-input" type="file" name="file_updoad" id="attach-file" accept="image/*"
                            required />
                        {{-- <input type='file' required /> --}}
                    </div>

                    <div class="form-field">
                        <label for="attach-file1" class="attach-btn1 btn-lite btn">
                            <span class="icon">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                        fill="black" />
                                </svg>
                            </span>
                            Attach Video (Max 5 MB)
                        </label>
                        <input class="attach-input" type="file" name="video_file_updoad" id="attach-file1"
                            accept="video/*" />
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
        <div class="modal__wrap">
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

                    <div class="form-field">
                        <label for="text-area">Author </label>
                        <select name="event_author" id="event_author" class="input">
                            @foreach ($author_created_list as $listA)
                                <option value="{{ $listA->id }}">{{ $listA->author_name }}</option>
                            @endforeach
                        </select>
                    </div>

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
    </div>


    <!-- Edit Event Modal -->
    <div class="edit-event-modal modal d-none" id="edit-event">
        <div class="modal__wrap">
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
    </div>

    <!-- Add Author Modal -->
    <div class="add-book-modal modal d-none" id="add-author">
        <div class="modal__wrap">
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
                <h3 class="title">Add New Author</h3>
                <form action="{{ url('publisher/add-author') }}" method="post" class="modal__form">
                    @csrf
                    @method('post')
                    <div class="form-row">
                        <div class="form-field">
                            <label class="label">Name*</label>
                            <input type="text" name="name" class="input" placeholder="First Name" />
                        </div>
                        <div class="form-field">
                            <input type="text" name="last_name" class="input" placeholder="Last Name" />
                        </div>

                    </div>


                    <div class="form-field">
                        <label for="email" class="label">Email *</label>
                        <input type="text" name="email" id="email" class="input" required />
                    </div>


                    <div class="form-field">
                        <label for="text-area">Country </label>
                        <select name="country" id="country" class="input">
                            @foreach ($country_list as $list)
                                <option>{{ $list->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="password" class="label">Phone</label>
                        <input type="number" name="phone" id="phone" class="input" />
                    </div>


                    <div class="form-field">
                        <label for="password" class="label">Password</label>
                        <input type="password" name="password" id="password" class="input" />
                    </div>



                    <div class="btn-group">
                        <button class="btn btn-lite">Cancel</button>
                        <button type="submit" class="btn btn-solid">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Author Modal -->
    <div class="add-book-modal modal d-none" id="edit-author">
        <div class="modal__wrap">
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
                <h3 class="title">Edit Author</h3>
                <form action="{{ url('publisher/update-author') }}" method="post" class="modal__form">

                    @csrf
                    @method('post')
                    <div id="editAuthorInputs"></div>



                    <div class="btn-group">
                        <button class="btn btn-lite">Cancel</button>
                        <button type="submit" class="btn btn-solid">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="add-media-modal modal d-none" id="add-media">
        <div class="modal__wrap">
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
                <h3 class="title">Add Feature Media</h3>
                <form action="{{ url('publisher/add-feature-media') }}" method="post" class="modal__form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="form-field">
                        <label for="attach-file-media" class="attach-btn btn-lite btn">
                            <span class="icon">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                        fill="black" />
                                </svg>
                            </span>
                            Attach File
                        </label>
                        <input class="attach-input" type="file" name="file" id="attach-file-media"
                            accept="image/*" />
                    </div>



                    <div class="btn-group">
                        <button class="btn btn-lite">Cancel</button>
                        <button class="btn btn-solid">Add Media</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Content Block -->
    <section class="body-content author-details-page alt-content">
        <div class="container">
            <div class="inner-content">
                <div class="tab-panel">
                    @if (check_publisher_max_book_by_user_id(session('author_id')) == 1)
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
                        @include('layouts.frontend.publisher_sidebar')
                    </nav>
                </div>
                <div class="tab-content space-0">


                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif


                    <!-- Content Block -->
                    <div class="profile-banner">
                        <img src="@if ($author->author_cover_picture) {{ asset($author->author_cover_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/cover.jpg @endif"
                            alt="" />
                        <a href="{{ url('settings') }}" style="float:right;">
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
                    <div class="block-wrap bg-none" style="padding-left: 0; padding-right: 0;">
                        <div class="block-component">
                            <div class="author-summary">
                                <div class="author-bio unit">
                                    <div class="author-profile-pic">
                                        <img src="@if ($author->author_profile_picture) {{ asset($author->author_profile_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile.jpg @endif"
                                            alt="" />
                                    </div>
                                    <a href="{{ url('settings') }}" style="">
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
                                    <h3 class="author-name">
                                        {{ session('author_name') }} {{ $author->author_last_name }}
                                    </h3>
                                    <p class="author-label">
                                        {{ $author->author_bio }}
                                    </p>
                                    <div class="author-email">
                                        <a href="{{ $author->author_website_link }}" target="_blank" class="link">
                                            {{ $author->author_website_link }}</a>
                                    </div>
                                    <p class="author-location">
                                        <span class="icon">
                                            <svg width="12" height="17" viewBox="0 0 12 17" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 0C4.4087 0 2.88258 0.656632 1.75736 1.82544C0.632141 2.99426 0 4.57951 0 6.23246C0 9.52433 5.34545 16.4877 5.57455 16.788C5.62566 16.8541 5.69042 16.9076 5.76406 16.9443C5.83769 16.9809 5.91833 17 6 17C6.08167 17 6.1623 16.9809 6.23594 16.9443C6.30958 16.9076 6.37434 16.8541 6.42545 16.788C6.65455 16.4877 12 9.52433 12 6.23246C12 4.57951 11.3679 2.99426 10.2426 1.82544C9.11742 0.656632 7.5913 0 6 0ZM6 7.93222C5.56848 7.93222 5.14665 7.7993 4.78785 7.55027C4.42905 7.30124 4.1494 6.94728 3.98426 6.53316C3.81913 6.11904 3.77592 5.66336 3.8601 5.22373C3.94429 4.7841 4.15209 4.38027 4.45722 4.06332C4.76235 3.74637 5.15112 3.53052 5.57435 3.44307C5.99758 3.35562 6.43627 3.4005 6.83495 3.57204C7.23362 3.74357 7.57437 4.03406 7.81412 4.40675C8.05386 4.77945 8.18182 5.21763 8.18182 5.66587C8.18182 6.26694 7.95195 6.8434 7.54278 7.26842C7.13361 7.69344 6.57865 7.93222 6 7.93222Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        {{ $author->author_country }}
                                    </p>
                                </div>
                                <div class="author-credit unit">
                                    <p class="credit__name">Books</p>
                                    <p class="creadit__no text-center">
                                        {{ get_author_total_books_count() }}
                                    </p>

                                    <p class="credit__name">Followers</p>
                                    <p class="creadit__no text-center">
                                        {{ get_author_total_followers_count() }}
                                    </p>
                                    <p class="credit__name">Events</p>
                                    <p class="creadit__no text-center">{{ get_author_total_events_count() }}</p>
                                </div>
                                <ul class="social-links unit">
                                    @if ($author->author_facebook_link)
                                        <li>
                                            <a href="{{ $author->author_facebook_link }}" target="_blank"
                                                class="link">
                                                <svg width="10" height="20" viewBox="0 0 10 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.14971 3.29509H9.96139V0.139742C9.64884 0.0967442 8.5739 0 7.32201 0C4.70992 0 2.92057 1.643 2.92057 4.66274V7.44186H0.0380859V10.9693H2.92057V19.845H6.45462V10.9701H9.22052L9.65958 7.44269H6.4538V5.01251C6.45462 3.99297 6.72915 3.29509 8.14971 3.29509Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($author->author_twitter_link)
                                        <li>
                                            <a href="{{ $author->author_twitter_link }}" target="_blank" class="link">
                                                <svg width="22" height="18" viewBox="0 0 22 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M22 2.11613C21.1819 2.475 20.3101 2.71288 19.4013 2.82838C20.3363 2.27013 21.0499 1.39287 21.3854 0.3355C20.5136 0.85525 19.5511 1.22238 18.5254 1.42725C17.6976 0.545875 16.5179 0 15.2309 0C12.7339 0 10.7236 2.02675 10.7236 4.51137C10.7236 4.86888 10.7539 5.21263 10.8281 5.53988C7.0785 5.357 3.76062 3.55988 1.53175 0.82225C1.14262 1.49738 0.914375 2.27012 0.914375 3.102C0.914375 4.664 1.71875 6.04862 2.91775 6.85025C2.19312 6.8365 1.48225 6.62613 0.88 6.29475C0.88 6.3085 0.88 6.32638 0.88 6.34425C0.88 8.536 2.44338 10.3565 4.4935 10.7759C4.12638 10.8763 3.72625 10.9244 3.311 10.9244C3.02225 10.9244 2.73075 10.9079 2.45712 10.8474C3.0415 12.6335 4.69975 13.9466 6.6715 13.9893C5.137 15.1896 3.18863 15.9129 1.07938 15.9129C0.7095 15.9129 0.35475 15.8964 0 15.851C1.99787 17.1394 4.36563 17.875 6.919 17.875C15.2185 17.875 19.756 11 19.756 5.04075C19.756 4.84137 19.7491 4.64887 19.7395 4.45775C20.6346 3.8225 21.3867 3.02913 22 2.11613Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($author->author_instagram_link)
                                        <li>
                                            <a href="{{ $author->author_instagram_link }}" target="_blank"
                                                class="link">
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.875 0H15.125C18.9214 0 22 3.07862 22 6.875V15.125C22 18.9214 18.9214 22 15.125 22H6.875C3.07862 22 0 18.9214 0 15.125V6.875C0 3.07862 3.07862 0 6.875 0ZM15.125 19.9375C17.7787 19.9375 19.9375 17.7787 19.9375 15.125V6.875C19.9375 4.22125 17.7787 2.0625 15.125 2.0625H6.875C4.22125 2.0625 2.0625 4.22125 2.0625 6.875V15.125C2.0625 17.7787 4.22125 19.9375 6.875 19.9375H15.125Z"
                                                        fill="#3E3E3E" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.5 11C5.5 7.96263 7.96263 5.5 11 5.5C14.0374 5.5 16.5 7.96263 16.5 11C16.5 14.0374 14.0374 16.5 11 16.5C7.96263 16.5 5.5 14.0374 5.5 11ZM7.5625 11C7.5625 12.8948 9.10525 14.4375 11 14.4375C12.8948 14.4375 14.4375 12.8948 14.4375 11C14.4375 9.10388 12.8948 7.5625 11 7.5625C9.10525 7.5625 7.5625 9.10388 7.5625 11Z"
                                                        fill="#3E3E3E" />
                                                    <circle cx="16.9126" cy="5.08737" r="0.732875" fill="#3E3E3E" />
                                                </svg>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($author->author_linkedin_link)
                                        <li>
                                            <a href="{{ $author->author_linkedin_link }}" target="_blank"
                                                class="link">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.5674 15.5677V9.86606C15.5674 7.06389 14.9642 4.92334 11.695 4.92334C10.1187 4.92334 9.06793 5.77956 8.63982 6.59686H8.6009V5.17631H5.50684V15.5677H8.73712V10.4109C8.73712 9.04876 8.99009 7.74497 10.6636 7.74497C12.3177 7.74497 12.3371 9.28228 12.3371 10.4888V15.5482H15.5674V15.5677Z"
                                                        fill="black" />
                                                    <path d="M0.25293 5.17627H3.48321V15.5677H0.25293V5.17627Z"
                                                        fill="black" />
                                                    <path
                                                        d="M1.86812 0C0.83676 0 0 0.83676 0 1.86811C0 2.89947 0.83676 3.75569 1.86812 3.75569C2.89947 3.75569 3.73623 2.89947 3.73623 1.86811C3.73623 0.83676 2.89947 0 1.86812 0Z"
                                                        fill="black" />
                                                </svg>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($author->author_youtube_link)
                                        <li>
                                            <a href="{{ $author->author_youtube_link }}" target="_blank" class="link">
                                                <svg width="20" height="14" viewBox="0 0 20 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M19.9767 4.93552C20.019 3.63946 19.7335 2.35358 19.1462 1.19624C18.7537 0.713261 18.2004 0.386524 17.5866 0.275222C15.0664 0.0573071 12.5367 -0.0312861 10.0073 0.00988647C7.47804 -0.0315034 4.94837 0.0570898 2.42831 0.275222C1.92907 0.368071 1.46684 0.600908 1.09584 0.946378C0.282466 1.69734 0.22309 2.98456 0.100629 4.06889C-0.0335428 6.02334 -0.0335428 7.98469 0.100629 9.93914C0.122766 10.5512 0.214771 11.1588 0.374862 11.7501C0.483287 12.2079 0.704136 12.6318 1.01754 12.9837C1.3886 13.3479 1.86098 13.5925 2.37343 13.6858C4.33338 13.9277 6.30849 14.0269 8.28297 13.9826V13.9827C11.4596 14.0333 14.2585 13.9797 17.5547 13.7328C18.0815 13.6428 18.5682 13.395 18.9499 13.0225C19.1979 12.7769 19.3856 12.4777 19.4987 12.1481C19.8274 11.1563 19.9889 10.1172 19.9767 9.0729C20.0078 8.53404 20.0078 5.47437 19.9767 4.93552ZM13.3305 6.8011C13.3294 6.80049 13.3283 6.79989 13.3271 6.79928C12.5733 7.21516 11.7019 7.65613 10.7833 8.12043C9.86033 8.58688 8.89042 9.07671 7.94604 9.58804V3.98317V3.98311C8.84348 4.45155 9.73115 4.91209 10.6237 5.37744C11.5151 5.84223 12.4115 6.31188 13.3271 6.79928C13.3306 6.79734 13.3348 6.79531 13.3383 6.79337L13.3305 6.8011Z"
                                                        fill="black" />
                                                </svg>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($author->author_pinterest_link)
                                        <li>
                                            <a href="{{ $author->author_pinterest_link }}" target="_blank"
                                                class="link">
                                                <img src="{{ asset('public/frontend_asset') }}/imgs/pinterest.png"
                                                    alt="" />
                                            </a>
                                        </li>
                                    @endif
                                    @if ($author->author_spotify_link)
                                        <li>
                                            <a href="{{ $author->author_spotify_link }}" target="_blank" class="link">
                                                <img src="{{ asset('public/frontend_asset') }}/imgs/spotify.png"
                                                    alt="" />
                                            </a>
                                        </li>
                                    @endif
                                    @if ($author->author_podcast_link)
                                        <li>
                                            <a href="{{ $author->author_podcast_link }}" target="_blank" class="link">
                                                <img src="{{ asset('public/frontend_asset') }}/imgs/podcast.png"
                                                    alt="" />
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                {{-- <a href="#" class="follow-btn unit btn-solid">Follow</a> --}}
                                <div class="discribe-author unit">
                                    <h4 class="title">About me</h4>
                                    <p class="dsc">
                                        {{ $author->author_description }}
                                    </p>
                                </div>
                                @if ($author->author_intro_video)
                                    <a href="#" class="video unit">
                                        {{-- <img src="{{asset('public/frontend_asset')}}/imgs/placeholder-14.png" alt="" /> --}}
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset($author->author_intro_video) }}" type="video/mp4">
                                            {{-- <source src="movie.ogg" type="video/ogg"> --}}
                                            Your browser does not support the video tag.
                                        </video>
                                        {{-- <span class="icon">
                                        <svg width="58" height="58" viewBox="0 0 58 58" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="29" cy="29" r="28.5" stroke="#3E3E3E" />
                                            <path
                                                d="M40 26.7679C41.3333 27.5378 41.3333 29.4623 40 30.2321L24.25 39.3253C22.9167 40.0951 21.25 39.1329 21.25 37.5933L21.25 19.4067C21.25 17.8671 22.9167 16.9049 24.25 17.6747L40 26.7679Z"
                                                fill="#656565" />
                                        </svg>
                                    </span> --}}
                                    </a>
                                @endif

                                @if (count($podcasts))
                                    <h3>Podcasts</h3>
                                    @foreach ($podcasts as $row)
                                        <style>
                                            iframe {
                                                display: block;
                                                /* iframes are inline by default */
                                                background: #000;
                                                border: none;
                                                /* Reset default border */
                                                height: auto;
                                                /* Viewport-relative units */
                                                width: 350px;
                                            }
                                        </style>

                                        <div class="event-card" style="padding: 0px 0px;">
                                            <figure class="figure">
                                                <img height="60px" width="60px"
                                                    src="@if ($author->author_profile_picture) {{ asset($author->author_profile_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile-banner.png @endif"
                                                    alt="" />
                                            </figure>
                                            <div class="content">
                                                <div class="event-card__row flex-wrap">
                                                    <h3 class="event-card__title">
                                                        {{ $row->podcast_name }}
                                                    </h3>

                                                </div>

                                                <p class="para">
                                                    <iframe {!!$row->podcast_embed_code!!}</iframe>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <p class="member-status unit">
                                    Member since {{ date('Y', strtotime($author->created_at)) }}
                                </p>
                            </div>
                            <div class="tabs-wrap space-0">
                                <div class="tabs-btns-row">
                                    <a href="#author" class="tab-btn btn-active">Author</a>
                                    <a href="#books" class="tab-btn ">
                                        Books</a>
                                    <a href="#events" class="tab-btn">
                                        Events</a>
                                    <a href="#media" class="tab-btn">Media</a>
                                    <a href="#followers" class="tab-btn">Followers</a>

                                </div>
                                <div class="tab-body">

                                    <div class="tab-body__inner author" id="author">
                                        <div class="authors-list">
                                            <div class="head">
                                                <h3>All Authors</h3>
                                                @if (check_publisher_max_author_by_user_id(session('author_id')) == 1)
                                                    <button class="btn-trigger" data-target="#add-author">Add New
                                                        Author</button>
                                                @else
                                                    <button class="btn-trigger"
                                                        onclick="alert('You have crossed the limit of your current membership plan!')">Add
                                                        New Author</button>
                                                @endif
                                            </div>

                                            <div class="authors-table table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl</th>
                                                            {{-- <th>Code</th> --}}
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            {{-- <th>Country</th> --}}
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($author_created_list as $list)
                                                            <tr>
                                                                <td>
                                                                    {{ $loop->iteration }}
                                                                </td>

                                                                {{-- <td>
                                                                    {{ $list->author_code }}
                                                                </td> --}}
                                                                <td>
                                                                    {{ $list->author_name }}
                                                                </td>
                                                                <td>
                                                                    {{ $list->author_last_name }}
                                                                </td>
                                                                <td>
                                                                    {{ $list->author_email }}
                                                                </td>
                                                                <td>
                                                                    {{ $list->author_phone }}
                                                                </td>
                                                                {{-- <td>
                                                                    {{ $list->author_country }}
                                                                </td> --}}

                                                                <td>
                                                                    <div class="table-actions">
                                                                        <a href="#" class="btn-trigger"
                                                                            onclick="editAuthor({{ $list->id }})">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 512 512">
                                                                                <path
                                                                                    d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z" />
                                                                            </svg>
                                                                        </a>




                                                                        <a href="{{ url('publisher/delete-author/' . $list->id) }}"
                                                                            onclick="return confirm('Are you sure !');">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 448 512">
                                                                                <path
                                                                                    d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z" />
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-body__inner books  d-none" id="books">
                                        <div class="grid-container">
                                            <div class="grid-items">
                                                @if (count($books))
                                                    @foreach ($books as $row)
                                                        <figure class="grid-item figure">
                                                            <a href="{{ url('edit-books/' . $row->id) }}"
                                                                style="float:right;">
                                                                <svg width="23" height="23" viewBox="0 0 23 23"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                            <a href="{{ url('book-details/' . $row->id) }}"><img
                                                                    src="{{ asset($row->bookDocuments[0]->path ?? '') }}"
                                                                    alt="" /></a>
                                                        </figure>
                                                    @endforeach
                                                @else
                                                    <p class="not-found">No books created yet!</p>
                                                    @if (check_user_max_book_by_user_id(session('author_id')) == 1)
                                                        <button class="add-btn btn-solid btn-trigger"
                                                            data-target="#add-book">
                                                            <span class="icon">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_2952_633)">
                                                                        <path
                                                                            d="M16.3929 7.39286H10.9286C10.7511 7.39286 10.6071 7.24894 10.6071 7.07143V1.60714C10.6071 0.719604 9.88754 0 9 0C8.11246 0 7.39286 0.719604 7.39286 1.60714V7.07143C7.39286 7.24894 7.24894 7.39286 7.07143 7.39286H1.60714C0.719604 7.39286 0 8.11246 0 9C0 9.88754 0.719604 10.6071 1.60714 10.6071H7.07143C7.24894 10.6071 7.39286 10.7511 7.39286 10.9286V16.3929C7.39286 17.2804 8.11246 18 9 18C9.88754 18 10.6071 17.2804 10.6071 16.3929V10.9286C10.6071 10.7511 10.7511 10.6071 10.9286 10.6071H16.3929C17.2804 10.6071 18 9.88754 18 9C18 8.11246 17.2804 7.39286 16.3929 7.39286Z"
                                                                            fill="white" />
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_2952_633">
                                                                            <rect width="18" height="18"
                                                                                fill="white" />
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                            Create
                                                        </button>
                                                    @else
                                                        <button class="add-btn btn-solid"
                                                            onclick="alert('You have crossed the limit of your current membership plan!')">
                                                            <span class="icon">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_2952_633)">
                                                                        <path
                                                                            d="M16.3929 7.39286H10.9286C10.7511 7.39286 10.6071 7.24894 10.6071 7.07143V1.60714C10.6071 0.719604 9.88754 0 9 0C8.11246 0 7.39286 0.719604 7.39286 1.60714V7.07143C7.39286 7.24894 7.24894 7.39286 7.07143 7.39286H1.60714C0.719604 7.39286 0 8.11246 0 9C0 9.88754 0.719604 10.6071 1.60714 10.6071H7.07143C7.24894 10.6071 7.39286 10.7511 7.39286 10.9286V16.3929C7.39286 17.2804 8.11246 18 9 18C9.88754 18 10.6071 17.2804 10.6071 16.3929V10.9286C10.6071 10.7511 10.7511 10.6071 10.9286 10.6071H16.3929C17.2804 10.6071 18 9.88754 18 9C18 8.11246 17.2804 7.39286 16.3929 7.39286Z"
                                                                            fill="white" />
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_2952_633">
                                                                            <rect width="18" height="18"
                                                                                fill="white" />
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                            Create New Book
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-body__inner d-none" id="events">
                                        @if (count($events))
                                            @foreach ($events as $row)
                                                <div class="event-card">
                                                    <figure class="figure">
                                                        <img height="60px" width="60px"
                                                            src="@if ($row->Author->author_profile_picture) {{ asset($row->Author->author_profile_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile-img.png @endif"
                                                            alt="" />
                                                    </figure>
                                                    <div class="content">
                                                        <div class="event-card__row flex-wrap">
                                                            <h3 class="event-card__title">
                                                                {{ $row->event_name }}
                                                            </h3>
                                                            <button class="icon btn-trigger btn"
                                                                onclick="updateinfo('{{ $row->id }}')">
                                                                <svg width="23" height="23" viewBox="0 0 23 23"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                            </button>
                                                        </div>
                                                        <p class="event-card__timezone flex-wrap">
                                                            {{ $row->event_date }}<span
                                                                class="center">{{ $row->event_starting_time }}-
                                                                {{ $row->event_ending_time }}
                                                            </span><span>{{ $row->event_location }}</span>
                                                        </p>
                                                        <p class="para">
                                                            {{ Illuminate\Support\Str::of($row->event_description)->words(10, ' ...') }}
                                                        </p>
                                                        <p class="para">
                                                            <a href="{{ $row->event_link }}" target="_blank">Join
                                                                Link</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No event created yet. Please create the first event!</p>
                                        @endif
                                        @if (check_user_max_event_by_user_id(session('author_id')) == '1')
                                            <a href="#" class="add-event-btn btn-trigger"
                                                data-target="#add-event">Add
                                                Event</a>
                                        @else
                                            <a href="#" class="add-event-btn"
                                                onclick="alert('You have crossed the limit of your current membership plan!')">Add
                                                Event</a>
                                        @endif
                                    </div>
                                    <div class="tab-body__inner author-media d-none" id="media">
                                        <div class="title-bar flex-equal">

                                            <button class="add-media btn-lite btn-trigger" data-target="#add-media">
                                                <span class="icon">
                                                    <svg width="22" height="22" viewBox="0 0 22 22"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                Add Feature Media
                                            </button>
                                        </div>
                                        <div class="media-wrap space-bottom">

                                            @php
                                                $mediaTotal = 0;
                                            @endphp

                                            @foreach ($feature_media as $rowMedia)
                                                @php
                                                    $mediaTotal++;
                                                @endphp
                                                <figure class="media-item image">
                                                    {{-- <a href="{{url('book-details/'.$rowMedia->id)}}"> --}}


                                                    <img src="{{ asset($rowMedia->path ?? '') }}" alt="" />

                                                    {{-- </a> --}}
                                                </figure>
                                            @endforeach




                                            @foreach ($books as $row1)
                                                @foreach ($row1->bookDocuments as $bookDocs)
                                                    @php
                                                        $mediaTotal++;
                                                    @endphp
                                                    <figure class="media-item image">
                                                        <a href="{{ url('book-details/' . $row1->id) }}">
                                                            @if ($bookDocs->type == 'IMAGE')
                                                                <img src="{{ asset($bookDocs->path ?? '') }}"
                                                                    alt="" />
                                                            @elseif($bookDocs->type == 'VIDEO')
                                                                <video width="320" height="240" controls>
                                                                    <source src="{{ asset($bookDocs->path ?? '') }}"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @endif
                                                        </a>
                                                    </figure>
                                                @endforeach
                                            @endforeach

                                            @if ($mediaTotal <= 0)
                                                <p class="author-media__title">
                                                    No media uploaded yet. Please upload the first media.
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="tab-body__inner followers d-none" id="followers">
                                        @if (count($author_followers))
                                            @foreach ($author_followers as $rowFollwer)
                                                <div class="follower-card flex-wrap">
                                                    <figure class="figure">
                                                        <img src="{{ asset($rowFollwer->followerUser->author_profile_picture ?? '') }}"
                                                            alt="" />
                                                    </figure>
                                                    <div class="follower-data">
                                                        <h3 class="name">
                                                            {{ $rowFollwer->followerUser->author_name ?? '' }}
                                                        </h3>
                                                        <div class="follower-data__row flex-wrap">
                                                            <p class="text">
                                                                Reader
                                                            </p>
                                                            {{-- <p class="text">
                                                        <span class="icon">
                                                            <svg width="12" height="12" viewBox="0 0 12 12"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M5.62183 6.04007C7.1003 6.04007 8.29883 4.87968 8.29883 3.44826C8.29883 2.01684 7.1003 0.856445 5.62183 0.856445C4.14336 0.856445 2.94482 2.01684 2.94482 3.44826C2.94482 4.87968 4.14336 6.04007 5.62183 6.04007Z"
                                                                    fill="#3E3E3E" />
                                                                <path
                                                                    d="M6.18926 6.55859H5.05421C4.38838 6.56063 3.72948 6.68963 3.11513 6.93821C2.50079 7.18679 1.94303 7.55009 1.4737 8.00737C1.00438 8.46465 0.632676 9.00695 0.379822 9.60331C0.126968 10.1997 -0.00208712 10.8384 2.55242e-05 11.4831C2.55242e-05 11.5518 0.0282297 11.6177 0.0784333 11.6663C0.128637 11.7149 0.196727 11.7422 0.267726 11.7422H10.9757C11.0501 11.7357 11.119 11.7021 11.1687 11.6482C11.2184 11.5943 11.2451 11.5242 11.2434 11.4519C11.2406 10.155 10.7072 8.91194 9.75999 7.99485C8.81276 7.07776 7.52885 6.56133 6.18926 6.55859Z"
                                                                    fill="#3E3E3E" />
                                                            </svg> </span>212 Followers
                                                    </p> --}}
                                                        </div>
                                                        <div class="follower-data__row flex-wrap">
                                                            <p class="text">
                                                                <span class="icon">
                                                                    <svg width="12" height="17"
                                                                        viewBox="0 0 12 17" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M6 0C4.4087 0 2.88258 0.656632 1.75736 1.82544C0.632141 2.99426 0 4.57951 0 6.23246C0 9.52433 5.34545 16.4877 5.57455 16.788C5.62566 16.8541 5.69042 16.9076 5.76406 16.9443C5.83769 16.9809 5.91833 17 6 17C6.08167 17 6.1623 16.9809 6.23594 16.9443C6.30958 16.9076 6.37434 16.8541 6.42545 16.788C6.65455 16.4877 12 9.52433 12 6.23246C12 4.57951 11.3679 2.99426 10.2426 1.82544C9.11742 0.656632 7.5913 0 6 0ZM6 7.93222C5.56848 7.93222 5.14665 7.7993 4.78785 7.55027C4.42905 7.30124 4.1494 6.94728 3.98426 6.53316C3.81913 6.11904 3.77592 5.66336 3.8601 5.22373C3.94429 4.7841 4.15209 4.38027 4.45722 4.06332C4.76235 3.74637 5.15112 3.53052 5.57435 3.44307C5.99758 3.35562 6.43627 3.4005 6.83495 3.57204C7.23362 3.74357 7.57437 4.03406 7.81412 4.40675C8.05386 4.77945 8.18182 5.21763 8.18182 5.66587C8.18182 6.26694 7.95195 6.8434 7.54278 7.26842C7.13361 7.69344 6.57865 7.93222 6 7.93222Z"
                                                                            fill="black" />
                                                                    </svg>
                                                                </span>{{ $rowFollwer->followerUser->author_country ?? '' }}
                                                            </p>
                                                            {{-- <p class="text">
                                                        <span class="icon">
                                                            <svg width="13" height="13" viewBox="0 0 8 7"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                                    fill="#3E3E3E" />
                                                            </svg> </span>2.5 Rating
                                                    </p> --}}
                                                        </div>
                                                    </div>
                                                    <div class="btn-group">
                                                        {{-- <a href="#" class="btn-lite btn">
                                                    <span class="icon">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_947_202)">
                                                                <path
                                                                    d="M9.56258 9.09156C8.60133 9.09156 7.68758 8.63594 6.98914 7.81031C6.35195 7.05562 5.98633 6.08313 5.98633 5.1425C5.98633 3.16812 7.5907 1.5625 9.56258 1.5625C11.5345 1.5625 13.1388 3.16813 13.1388 5.14125C13.1388 6.08188 12.7732 7.05438 12.136 7.80906C11.4376 8.63594 10.5238 9.09156 9.56258 9.09156ZM9.56258 3.125C9.02837 3.12599 8.51636 3.33882 8.13885 3.71679C7.76135 4.09477 7.54916 4.60704 7.54883 5.14125C7.54883 6.22281 8.44695 7.52906 9.56258 7.52906C10.6782 7.52906 11.5763 6.22281 11.5763 5.14125C11.576 4.60704 11.3638 4.09477 10.9863 3.71679C10.6088 3.33882 10.0968 3.12599 9.56258 3.125Z"
                                                                    fill="#3E3E3E" />
                                                                <path
                                                                    d="M15.2188 16C15.0115 16 14.8128 15.9177 14.6663 15.7712C14.5198 15.6247 14.4375 15.426 14.4375 15.2188V13.6985C14.4375 12.4485 13.6922 11.7041 12.4438 11.7041H6.68125C5.43125 11.7041 4.6875 12.4497 4.6875 13.6985V15.2188C4.6875 15.426 4.60519 15.6247 4.45868 15.7712C4.31216 15.9177 4.11345 16 3.90625 16C3.69905 16 3.50034 15.9177 3.35382 15.7712C3.20731 15.6247 3.125 15.426 3.125 15.2188V13.6985C3.125 12.6672 3.46875 11.7785 4.11438 11.1313C4.76 10.4841 5.64937 10.1416 6.68125 10.1416H12.4438C13.475 10.1416 14.3634 10.4854 15.0106 11.1313C15.6578 11.7772 16 12.6663 16 13.6985V15.2188C16 15.426 15.9177 15.6247 15.7712 15.7712C15.6247 15.9177 15.426 16 15.2188 16Z"
                                                                    fill="#3E3E3E" />
                                                                <path
                                                                    d="M4.46875 8.46875H0.78125C0.57405 8.46875 0.375336 8.38644 0.228823 8.23993C0.08231 8.09341 0 7.8947 0 7.6875C0 7.4803 0.08231 7.28159 0.228823 7.13507C0.375336 6.98856 0.57405 6.90625 0.78125 6.90625H4.46875C4.67595 6.90625 4.87466 6.98856 5.02118 7.13507C5.16769 7.28159 5.25 7.4803 5.25 7.6875C5.25 7.8947 5.16769 8.09341 5.02118 8.23993C4.87466 8.38644 4.67595 8.46875 4.46875 8.46875Z"
                                                                    fill="#3E3E3E" />
                                                                <path
                                                                    d="M2.625 10.2969C2.4178 10.2969 2.21909 10.2146 2.07257 10.0681C1.92606 9.92154 1.84375 9.72283 1.84375 9.51562V5.85938C1.84375 5.65217 1.92606 5.45346 2.07257 5.30695C2.21909 5.16043 2.4178 5.07812 2.625 5.07812C2.8322 5.07812 3.03091 5.16043 3.17743 5.30695C3.32394 5.45346 3.40625 5.65217 3.40625 5.85938V9.51562C3.40625 9.61822 3.38604 9.71981 3.34678 9.8146C3.30752 9.90938 3.24997 9.99551 3.17743 10.0681C3.10488 10.1406 3.01876 10.1981 2.92397 10.2374C2.82919 10.2767 2.7276 10.2969 2.625 10.2969Z"
                                                                    fill="#3E3E3E" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_947_202">
                                                                    <rect width="16" height="16" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Follow
                                                </a> --}}
                                                        <a href="{{ url('user-details/' . $rowFollwer->user_id) }}"
                                                            class="btn-solid btn">
                                                            View Profile
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No followers yet</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        function updateinfo(id) {
            console.log('Hello');
            showCalimaticLoader();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('authors-get-event') }}", // Check this URL
                data: {
                    id: id
                },
                success: function(data, textStatus, jqXHR) {
                    HideCalimaticLoader();
                    $('#editEventInputs').html(data);
                    $('#edit-event').removeClass('d-none');
                    $('#edit-event').modal('toggle');
                    $(".success_msg").html("Data Save Successfully");
                    $(".success_msg").show();
                }
            }).fail(function(data, textStatus, jqXHR) {
                HideCalimaticLoader();
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after("<span class='error_msg' style='color: red;font-weight: 600'>" +
                        value + "</span>");
                });
            });
        }

        function editAuthor(id) {
            showCalimaticLoader();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('publisher-get-author') }}", // Check this URL
                data: {
                    id: id
                },
                success: function(data, textStatus, jqXHR) {
                    HideCalimaticLoader();
                    $('#editAuthorInputs').html(data);
                    $('#edit-author').removeClass('d-none');
                    $('#edit-author').modal('toggle');
                    $(".success_msg").html("Data Save Successfully");
                    $(".success_msg").show();
                }
            }).fail(function(data, textStatus, jqXHR) {
                HideCalimaticLoader();
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after("<span class='error_msg' style='color: red;font-weight: 600'>" +
                        value + "</span>");
                });
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            // Initially hide the book_author field and disable the author label
            $('#book_author, #author_label, #author_text').addClass('hidden');

            // On radio button change
            $('input[name="author_define"]').change(function() {
                if ($(this).val() === 'Author') {
                    // If Author is selected, show the book_author field and enable the author label
                    $('#book_author, #author_label, #author_text').removeClass('hidden');
                } else {
                    // If Publisher is selected, hide the book_author field and disable the author label
                    $('#book_author, #author_label, #author_text').addClass('hidden');
                }
            });
        });
    </script>
    <script>
        function validateForm() {
            var authorDefine = document.querySelector('input[name="author_define"]:checked');

            if (!authorDefine) {
                alert('Please select a role (Publisher or Author).');
                return;
            }

            // Additional validation logic can be added here if needed

            // If the form is valid, you can submit it
            document.getElementById('myForm').submit();
        }
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
        function showAlert(radioButton) {

            radioButton.disabled = true;
            radioButton.checked = false;
            // Delay the alert by a short amount of time (e.g., 100 milliseconds)
            setTimeout(function() {
                alert('You have crossed the limit of your current membership plan!');
            }, 100);

            // The radio button will be checked before the alert is triggered
        }
    </script>

@endsection
