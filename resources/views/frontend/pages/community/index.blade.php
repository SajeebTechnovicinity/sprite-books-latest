@extends('master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" />
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <style>
        /* Edit button style */
        .edit-btn {
            display: inline-block;
            background-color: #ffc107;
            /* Yellow */
            color: #000;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            /* Add margin between buttons */
            transition: background-color 0.3s ease;
        }

        .edit-btn:hover {
            background-color: #ffca28;
            /* Darker yellow on hover */
        }

        /* Delete button style */
        #dropdownContent a:nth-child(2) {
            display: inline-block;
            background-color: #dc3545;
            /* Red */
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        #dropdownContent a:nth-child(2):hover {
            background-color: #c82333;
            /* Darker red on hover */
        }
    </style>

    <!-- Add Book Modal -->
    <div class="add-community-modal modal d-none" id="edit-community">
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
            <h3 class="title">Edit Community</h3>
            <form action="{{ url('author/update-community/' . $community->id) }}" method="post" class="modal__form"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-field">
                    <label for="title" class="label">Community Name*</label>
                    <input type="text" name="community_name" id="title" value="{{ $community->community_name }}"
                        class="input" />
                </div>

                <div class="form-field">
                    <label for="dsc" class="label">Community Description*</label>
                    <textarea name="community_description" id="dsc" value="{{ $community->community_description }}" class="textarea">{{ $community->community_description }}</textarea>
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
                        Edit Cover Image (Max: 512 KB)
                    </label>
                    <br>
                    <br>
                    (Recommanded: 1200x500 px)
                    <input class="attach-input" type="file" name="file_updoad" id="attach-file" accept="image/*" />
                </div>
                <div class="btn-group">
                    <button class="btn btn-lite">Cancel</button>
                    <button class="btn btn-solid">Update Community</button>
                </div>
            </form>
        </div>
    </div>

    <div class="add-community-modal modal d-none" id="add-community">
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
            <h3 class="title">Create your Community</h3>
            <form action="{{ url('author/create-community') }}" method="post" class="modal__form"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-field">
                    <label for="title" class="label">Community Name*</label>
                    <input type="text" name="community_name" id="title" class="input" />
                </div>

                <div class="form-field">
                    <label for="dsc" class="label">Community Description*</label>
                    <textarea name="community_description" id="dsc" class="textarea"></textarea>
                </div>


                <div class="form-field">
                    <label for="attach-file" class="attach-btn btn-lite btn" style="width: 100%;">
                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <span class="text">
                            Cover Image (Max: 512KB)
                            <span class="inner">
                                (Recommended: 1200x500 px)
                            </span>
                        </span>

                    </label>
                    <input class="attach-input" type="file" name="file_updoad" id="attach-file" accept="image/*" />
                </div>
                <div class="btn-group">
                    <button class="btn btn-lite">Cancel</button>
                    <button class="btn btn-solid">Create Community</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Add Book Modal -->
    <div class="add-book-modal modal d-none" id="add-book">
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
                <h3 class="title">Add your Book</h3>
                <form action="{{ url('author/add-books') }}" method="post" class="modal__form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="form-field">
                        <label for="isbn" class="label">ISBN*</label>
                        <input type="text" name="isbn" id="isbn" class="input" />
                    </div>

                    <div class="form-field">
                        <label for="title" class="label">Book Title*</label>
                        <input type="text" name="book_name" id="title" class="input" />
                    </div>

                    <div class="form-field">
                        <label for="dsc" class="label">Book Description*</label>
                        <textarea name="book_description" id="dsc" class="textarea"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="links" class="label">Book Amazon Links*</label>
                            <input type="text" name="book_amazon_link" id="links" class="input"
                                placeholder="Max 250 character" />
                        </div>

                    </div>


                    <div class="form-row">
                        <div class="form-field">
                            <label for="links" class="label">Book Ebay Links*</label>
                            <input type="text" name="book_ebay_link" id="links" class="input"
                                placeholder="Max 250 character" />
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
                            <input type="text" name="book_discount_in_percentage" class="input" placeholder=""
                                pattern="\d+(\.\d+)?" title="Enter a valid number" />
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label class="label">Main Price to Show*</label>
                            <input type="text" name="book_price" class="input" pattern="\d+(\.\d+)?"
                                placeholder="Price" required />
                        </div>

                        <div class="form-field">
                            <label class="label">Book Price</label>
                            <input type="text" name="hard_book_price" class="input" pattern="\d+(\.\d+)?"
                                placeholder="HardBook" />
                        </div>
                        <div class="form-field">
                            <label class="label">Ebook Price</label>
                            <input type="text" name="ebook_price" class="input" pattern="\d+(\.\d+)?"
                                placeholder="Ebook" />
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
                            Attach File(s)*
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
                            Attach Video*
                        </label>
                        <input class="attach-input" type="file" name="video_file_updoad" id="attach-file1"
                            accept="video/*" required />
                    </div> --}}

                    <div class="form-row">
                        <div class="form-field">
                            <label for="links" class="label">Video Link</label>
                            <input type="text" name="video_file_updoad" id="links" class="input" />
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="links" class="label">Meta Key*</label>
                            <input type="text" name="meta_key" class="input" required />
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
    <!-- Content Block -->
    <section class="body-content community-details-page">
        <div class="container">
            <div class="inner-content">
                <div class="tab-panel">
                    @if (session('type') != 'USER')
                        <button class="add-btn btn-solid btn-trigger" data-target="#add-community">
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
                            Create Community
                        </button>
                    @endif
                    <nav>
                        @if (session('type') == 'USER')
                            @include('layouts.frontend.user_sidebar')
                        @elseif (session('type') == 'AUTHOR')
                            @include('layouts.frontend.author_sidebar')
                        @elseif (session('type') == 'PUBLISHER')
                            @include('layouts.frontend.publisher_sidebar')
                        @endif
                    </nav>
                </div>
                <div class="tab-content community_d_tab-content space-0">
                    <!-- Content Block -->
                    <div class="profile-banner">
                        <img src="{{ asset($community->community_cover_image) }}" alt="" />
                        <div class="profile_bannere_name">Readers Group by {{ $community->communityAuthor->author_name }}
                        </div>
                    </div>
                    <div class="community_d-info flex-wrap">
                        <div class="comm-author-datails">
                            <div class="community-d__title">{{ $community->community_name }}</div>
                            <div id="notification"></div>
                            <div class="community-d__follower">
                                {{ count($community_members) }} members

                                {{-- | 10 posts a week --}}
                            </div>
                        </div>
                        <div class="more_author">
                            <img src="{{ asset('public/frontend_asset') }}/imgs/community-d-more author.png"
                                alt="" />
                        </div>
                    </div>
                    <div class="block-wrap space-0 bg-none">
                        <div class="block-component">
                            <div class="tabs-wrap space-0">
                                <div class="tabs-btns-row gap">
                                    <div class="tab-btns">
                                        <a href="#About" class="tab-btn"> About</a>
                                        <a href="#Explore" class="tab-btn btn-active"> Explore</a>
                                        <a href="#Mycommunity" class="tab-btn">My community</a>
                                        <a href="#Members" class="tab-btn">Members</a>
                                    </div>
                                    @if ($community->author_id == session('author_id'))
                                        <div class="dropdown">
                                            <a href="#" class="more-tabs" id="dropdownButton">
                                                <svg width="37" height="37" viewBox="0 0 37 37" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <!-- Your SVG code -->
                                                </svg>
                                            </a>
                                            <div class="dropdown-content" id="dropdownContent" style="margin-bottom:10px;">
                                                <a href="#" class="add-btn btn-trigger edit-btn" data-target="#edit-community">Edit</a>
                                                <a href="{{ url('author/delete-community/' . $community->id) }}"
                                                    onclick="confirmCancellation(event)">Delete</a>
                                               
                                            </div>
                                           
                                        </div>
                                        
                                    @endif
                                </div>
                                <div class="tab-body">
                                    <div class="tab-body__inner d-none about" id="About">
                                        <div class="author flex gp-20">
                                            <div class="autho_img">
                                                <img height="60px" width="60px"
                                                    src="@if ($community->communityAuthor->author_profile_picture) {{ asset($community->communityAuthor->author_profile_picture) }} @else {{ asset('public/frontend_asset/imgs/profile.jpg') }} @endif"
                                                    alt="No Image available" />
                                            </div>
                                            <div class="author_name">{{ $community->communityAuthor->author_name }}</div>
                                        </div>
                                        <div class="created flex mt-20">
                                            <div class="created_title">Created by</div>
                                            <div class="creater_name">{{ $community->communityAuthor->author_name }}</div>
                                        </div>
                                        <div class="created flex mt-20">
                                            <div class="created_title">Created on</div>
                                            <div class="created_date">
                                                {{ \Carbon\Carbon::parse($community->created_at)->format('d/m/Y') }}
                                            </div>
                                        </div>
                                        <br>
                                        <p class="dec">
                                            {{ $community->community_description }}
                                        </p>

                                    </div>
                                    <div id="showMessage"><br></div>
                                    <div id="errorMessage"><br></div>
                                    <div class="tab-body__inner explore" id="Explore">
                                        <div class="explore-inner">
                                            <div class="posts flex">
                                                <div class="create-post">

                                                    <div class="create-post_header flex">
                                                        <div>
                                                            <svg width="60" height="60" viewBox="0 0 60 60"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="30" cy="30" r="30"
                                                                    fill="#EDF2F6" />
                                                                <path d="M30.2578 37.99H39.5157" stroke="#3E3E3E"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M34.8868 22.5803C35.296 22.2087 35.851 22 36.4298 22C36.7163 22 37.0001 22.0512 37.2648 22.1508C37.5296 22.2504 37.7701 22.3963 37.9727 22.5803C38.1754 22.7642 38.3361 22.9826 38.4458 23.223C38.5554 23.4634 38.6119 23.721 38.6119 23.9812C38.6119 24.2413 38.5554 24.4989 38.4458 24.7393C38.3361 24.9797 38.1754 25.1981 37.9727 25.382L25.1146 37.0561L21 37.99L22.0287 34.2543L34.8868 22.5803Z"
                                                                    stroke="#3E3E3E" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        Create Post
                                                    </div>
                                                    <div class="create-post_body">
                                                        <form id="add_post_form" enctype="multipart/form-data">

                                                            {{-- <span id="charCount" style="margin-left:100px;">0</span>/100 --}}

                                                            <div class="input-area flex">

                                                                <figure class="img">
                                                                    <img src="@if ($current_user->author_cover_picture) {{ asset($current_user->author_cover_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile.jpg @endif"
                                                                        alt="" />
                                                                </figure>


                                                                <div class="inpts">
                                                                    <input class="input" placeholder="Enter your title"
                                                                        type="text" name="title" id="postInput" />


                                                                    <textarea style="margin-top: 15px;" class="input" name="post" rows="3"
                                                                        placeholder="Share what on your mind?"></textarea>

                                                                    <input class="input" type="hidden"
                                                                        name="community_id"
                                                                        value="{{ $community->id }}" />
                                                                </div>


                                                            </div>
                                                            <div class="cp-footer">
                                                                <label class="fpu">
                                                                    <input class="input" style="display: none;"
                                                                        type="file" name="post_image" />
                                                                    <svg width="20" height="19"
                                                                        viewBox="0 0 20 19" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M17 1H3C1.89543 1 1 1.81297 1 2.81582V15.5266C1 16.5294 1.89543 17.3424 3 17.3424H17C18.1046 17.3424 19 16.5294 19 15.5266V2.81582C19 1.81297 18.1046 1 17 1Z"
                                                                            stroke="#E8922D" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M6.5 7.35538C7.32843 7.35538 8 6.74565 8 5.99352C8 5.24138 7.32843 4.63165 6.5 4.63165C5.67157 4.63165 5 5.24138 5 5.99352C5 6.74565 5.67157 7.35538 6.5 7.35538Z"
                                                                            stroke="#E8922D" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path d="M19 11.8949L14 7.35538L3 17.3424"
                                                                            stroke="#E8922D" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                    Photo/Video(Max: 5 MB) (Recommended: 750x450 px)
                                                                </label>



                                                                <button class="btn btn-success"
                                                                    type='submit'>Post</button>

                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <div id="latestPost"></div>
                                                @foreach ($community_post as $rowPost)
                                                    <div class="post">
                                                        <div class="post__header flex-equal">
                                                            <div class="author__info flex">
                                                                <div class="author_img">
                                                                    <img src="@if ($rowPost->Author->author_profile_picture) {{ asset($rowPost->Author->author_profile_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile.jpg @endif"
                                                                        alt="" />
                                                                </div>
                                                                <div class="info">
                                                                    <div class="name">
                                                                        {{ $rowPost->Author->author_name . ' ' . $rowPost->Author->author_last_name }}
                                                                    </div>
                                                                    <div class="post-date">
                                                                        {{ $rowPost->date }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="more-option">
                                                                <svg width="37" height="37" viewBox="0 0 37 37"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="18.5" cy="18.5" r="18.5"
                                                                        fill="#EDF2F6" />
                                                                    <path
                                                                        d="M15.2857 17.0714V19.2143C15.2857 19.8058 14.8058 20.2857 14.2143 20.2857H12.0714C11.4799 20.2857 11 19.8058 11 19.2143V17.0714C11 16.4799 11.4799 16 12.0714 16H14.2143C14.8058 16 15.2857 16.4799 15.2857 17.0714ZM21 17.0714V19.2143C21 19.8058 20.5201 20.2857 19.9286 20.2857H17.7857C17.1942 20.2857 16.7143 19.8058 16.7143 19.2143V17.0714C16.7143 16.4799 17.1942 16 17.7857 16H19.9286C20.5201 16 21 16.4799 21 17.0714ZM26.7143 17.0714V19.2143C26.7143 19.8058 26.2344 20.2857 25.6429 20.2857H23.5C22.9085 20.2857 22.4286 19.8058 22.4286 19.2143V17.0714C22.4286 16.4799 22.9085 16 23.5 16H25.6429C26.2344 16 26.7143 16.4799 26.7143 17.0714Z"
                                                                        fill="#C0C0C0" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="post__dec">
                                                            <b>{{ $rowPost->title }}</b>
                                                        </div>
                                                        <div class="post__dec">
                                                            {{ $rowPost->post }}
                                                        </div>
                                                        @if ($rowPost->post_image)
                                                            <div class="post__thamp-img">
                                                                <img src="{{ asset($rowPost->post_image) }}"
                                                                    alt="" />
                                                            </div>
                                                        @endif
                                                        <div class="post__react flex">
                                                            <div class="likes flex likePost"
                                                                data-id="{{ $rowPost->id }}"
                                                                data-community="{{ $rowPost->community_id }}">
                                                                <svg id="postLikeIcon{{ $rowPost->id }}" width="30"
                                                                    height="28" viewBox="0 0 30 28"
                                                                    @if (get_like_data($rowPost->id, $rowPost->community_id)) fill="blue"
                                                            @else
                                                            fill="none" @endif
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M21.406 25.9996H24.9349C25.6829 26.0116 26.4098 25.7738 26.9774 25.3314C27.5451 24.889 27.9141 24.2727 28.0144 23.5996V15.1998C27.9141 14.5266 27.5451 13.9104 26.9774 13.468C26.4098 13.0256 25.6829 12.7878 24.9349 12.7998H21.406M12.1541 10.3998V5.59994C12.1541 4.64517 12.5719 3.72952 13.3155 3.0544C14.059 2.37928 15.0676 2 16.1192 2L21.406 12.7998V25.9996H6.49726C5.85977 26.0061 5.24115 25.8033 4.75539 25.4284C4.26963 25.0535 3.94946 24.5319 3.85387 23.9596L2.02993 13.1598C1.97243 12.8158 1.99798 12.4646 2.10482 12.1305C2.21166 11.7964 2.39723 11.4874 2.64867 11.2249C2.90012 10.9623 3.21142 10.7526 3.56102 10.6101C3.91062 10.4677 4.29015 10.3959 4.67332 10.3998H12.1541Z"
                                                                        stroke="#C0C0C0" stroke-width="3"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                                <span class="like-num"
                                                                    id="postLikeCount{{ $rowPost->id }}">
                                                                    {{ get_post_like_count($rowPost->id, $rowPost->community_id) }}
                                                                </span>
                                                            </div>
                                                            <div class="dis_likes flex dislikePost"
                                                                data-id="{{ $rowPost->id }}"
                                                                data-community="{{ $rowPost->community_id }}">
                                                                <svg id="postdislikeIcon{{ $rowPost->id }}"
                                                                    width="30" height="28" viewBox="0 0 30 28"
                                                                    @if (get_dislike_data($rowPost->id, $rowPost->community_id)) fill="blue"
                                                            @else
                                                            fill="none" @endif
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M20.906 2.00043H24.4349C25.1829 1.98842 25.9098 2.22619 26.4774 2.6686C27.0451 3.11102 27.4141 3.72727 27.5144 4.40039V12.8002C27.4141 13.4734 27.0451 14.0896 26.4774 14.532C25.9098 14.9744 25.1829 15.2122 24.4349 15.2002H20.906M11.6541 17.6002V22.4001C11.6541 23.3548 12.0719 24.2705 12.8155 24.9456C13.559 25.6207 14.5676 26 15.6192 26L20.906 15.2002V2.00043H5.99726C5.35977 1.99389 4.74115 2.19674 4.25539 2.57162C3.76963 2.94649 3.44946 3.46812 3.35387 4.0404L1.52993 14.8402C1.47243 15.1842 1.49798 15.5354 1.60482 15.8695C1.71166 16.2036 1.89723 16.5126 2.14867 16.7751C2.40012 17.0377 2.71142 17.2474 3.06102 17.3899C3.41062 17.5323 3.79015 17.6041 4.17332 17.6002H11.6541Z"
                                                                        stroke="#C0C0C0" stroke-width="3"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                                <span class="dislikes-num"
                                                                    id="postdisLikeCount{{ $rowPost->id }}">
                                                                    {{ get_post_dislike_count($rowPost->id, $rowPost->community_id) }}
                                                                </span>
                                                            </div>
                                                            <div class="comment flex">
                                                                <svg width="31" height="27" viewBox="0 0 31 27"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9.4375 10.9375C8.38281 10.9375 7.5625 11.8164 7.5625 12.8125C7.5625 13.8672 8.38281 14.6875 9.4375 14.6875C10.4336 14.6875 11.3125 13.8672 11.3125 12.8125C11.3125 11.8164 10.4336 10.9375 9.4375 10.9375ZM16 10.9375C14.9453 10.9375 14.125 11.8164 14.125 12.8125C14.125 13.8672 14.9453 14.6875 16 14.6875C16.9961 14.6875 17.875 13.8672 17.875 12.8125C17.875 11.8164 16.9961 10.9375 16 10.9375ZM22.5625 10.9375C21.5078 10.9375 20.6875 11.8164 20.6875 12.8125C20.6875 13.8672 21.5078 14.6875 22.5625 14.6875C23.5586 14.6875 24.4375 13.8672 24.4375 12.8125C24.4375 11.8164 23.5586 10.9375 22.5625 10.9375ZM16 0.625C7.67969 0.625 1 6.13281 1 12.8125C1 15.625 2.11328 18.2031 4.04688 20.2539C3.22656 22.5391 1.41016 24.5312 1.35156 24.5312C0.941406 24.9414 0.882812 25.5273 1.05859 26.0547C1.29297 26.582 1.82031 26.875 2.40625 26.875C5.98047 26.875 8.85156 25.4102 10.5508 24.1797C12.25 24.707 14.0664 25 16 25C24.2617 25 31 19.5508 31 12.8125C31 6.13281 24.2617 0.625 16 0.625ZM16 22.1875C14.418 22.1875 12.8359 21.9531 11.3711 21.4844L10.0234 21.0742L8.91016 21.8945C8.08984 22.4805 6.91797 23.125 5.51172 23.5938C5.98047 22.8906 6.39062 22.0703 6.68359 21.25L7.32812 19.6094L6.09766 18.3203C5.04297 17.207 3.8125 15.332 3.8125 12.8125C3.8125 7.65625 9.26172 3.4375 16 3.4375C22.6797 3.4375 28.1875 7.65625 28.1875 12.8125C28.1875 18.0273 22.6797 22.1875 16 22.1875Z"
                                                                        fill="#C0C0C0" />
                                                                </svg>
                                                                <span class="comment-num"
                                                                    id="postCommentsCount{{ $rowPost->id }}">{{ get_post_comments_data_count($rowPost->id, $rowPost->community_id) }}</span>
                                                            </div>
                                                        </div>


                                                        <div class="body_comment" id="commentSection{{ $rowPost->id }}">
                                                            @foreach (get_post_comments_data($rowPost->id, $rowPost->community_id) as $rowComment)
                                                                <div class="row">
                                                                    <ul id="list_comment" class="col-md-12">
                                                                        <!-- Start List Comment 1 -->
                                                                        <li class="box_result row">
                                                                            <div class="avatar_comment col-md-1">
                                                                                <img src="@if ($rowComment->Author->author_cover_picture) {{ asset($rowComment->Author->author_cover_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile.jpg @endif"
                                                                                    alt="avatar" />
                                                                            </div>
                                                                            <div class="result_comment col-md-11">
                                                                                <h4>
                                                                                    {{ $rowComment->Author->author_name . ' ' . $rowComment->Author->author_last_name }}
                                                                                </h4>
                                                                                <p>
                                                                                    {{ $rowComment->comment }}
                                                                                </p>
                                                                                <div class="tools_comment">
                                                                                    {{-- <a class="like"
                                                                                        href="#">Like</a>
                                                                                    <span aria-hidden="true">
                                                                                        ·
                                                                                    </span>

                                                                                    <span aria-hidden="true">
                                                                                        ·
                                                                                    </span> --}}
                                                                                    <span>{{ $rowComment->date }}</span>
                                                                                </div>



                                                                            </div>
                                                                        </li>

                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        </div>


                                                        <div class="comments_input flex">
                                                            <img src="@if ($current_user->author_cover_picture) {{ asset($current_user->author_cover_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile.jpg @endif"
                                                                alt="" />
                                                            <input type="text" placeholder="Write your comment"
                                                                class="writeComment" data-id="{{ $rowPost->id }}"
                                                                data-community="{{ $rowPost->community_id }}" />
                                                        </div>
                                                    </div>
                                                @endforeach



                                            </div>

                                            <div class="wegets">
                                                <div class="inner-wegets">
                                                    <div class="wegets_title">About</div>
                                                    <div class="about-forum">About {{ $community->community_name }}</div>
                                                    <div class="dec text">
                                                        {{ $community->community_description }}
                                                    </div>
                                                    <div class="created-by created-title">
                                                        Created by
                                                    </div>
                                                    <div class="created-by_nem text">
                                                        {{ $community->communityAuthor->author_name }}
                                                    </div>
                                                    <div class="created-on created-title">
                                                        Created on
                                                    </div>
                                                    <div class="created-date text">
                                                        {{ \Carbon\Carbon::parse($community->created_at)->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-body__inner author-media d-none" id="Mycommunity">
                                        <div class="author-grid">

                                            @if (count(get_user_community_list_by_user_id(session('author_id'))))
                                                @foreach (get_user_community_list_by_user_id(session('author_id')) as $rowCommunity)
                                                    @if (session('type') == 'USER')
                                                        <div class="grid-item author-item">
                                                            <a
                                                                href="{{ url('community/' . $rowCommunity->Community->id) }}">
                                                                <img src="@if ($rowCommunity->Community->community_cover_image) {{ asset($rowCommunity->Community->community_cover_image) }} @else {{ asset('public/frontend_asset/imgs/profile.jpg') }} @endif"
                                                                    alt="" />
                                                                <div class="title">
                                                                    {{ $rowCommunity->Community->community_name }}
                                                                </div>
                                                            </a>
                                                            {{-- <div class="text">Copywriter</div> --}}
                                                        </div>
                                                    @else
                                                        <div class="grid-item author-item">
                                                            <a href="{{ url('community/' . $rowCommunity->id) }}">
                                                                <img src="@if ($rowCommunity->community_cover_image) {{ asset($rowCommunity->community_cover_image) }} @else {{ asset('public/frontend_asset/imgs/profile.jpg') }} @endif"
                                                                    alt="" />
                                                                <div class="title">{{ $rowCommunity->community_name }}
                                                                </div>
                                                            </a>
                                                            {{-- <div class="text">Copywriter</div> --}}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <p>No more community</p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="tab-body__inner members d-none" id="Members">
                                        <div class="grid-container">
                                            <div class="grid-items">
                                                @if (count($community_members))
                                                    @foreach ($community_members as $rowMember)
                                                        <div class="grid-item author-item">
                                                            <img src="@if ($rowMember->Follower->author_profile_picture) {{ asset($rowMember->Follower->author_profile_picture) }} @else {{ asset('public/frontend_asset/imgs/profile.jpg') }} @endif"
                                                                alt="" />
                                                            <div class="title">{{ $rowMember->Follower->author_name }}
                                                            </div>
                                                            {{-- <div class="text">Copywriter</div> --}}
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
            </div>
        </div>
    </section>


    <script>
        window.laravel_echo_port = 6001;
    </script>
    <!-- <script src="//{{ Request::getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script> -->




    {{-- <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script> --}}
    {{-- <script src="http://localhost:6001/socket.io/socket.io.js"></script> --}}



    <script src="https://cdn.socket.io/4.4.0/socket.io.min.js"
        integrity="sha384-1fOn6VtTq3PWwfsOrk45LnYcGosJwzMHv+Xh/Jx5303FVOXzEnw0EpLv30mtjmlj" crossorigin="anonymous">
    </script>
    <script src="{{ url('/public/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ url('/public/js/laravel-echo-setup.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        var i = 0;

        window.Echo.channel('user-channel')
            .listen('.UserEvent', (data) => {
                i++;

                console.log(data);

                let base_url = window.location.origin;

                let newPost = `  <div class="post">
                              <div class="post__header flex-equal">
                                <div class="author__info flex">
                                  <div class="author_img">
                                    <img src="` + data.data.user_profile_picture + `" alt="" />
                                  </div>
                                  <div class="info">
                                    <div class="name">` + data.data.user_name + `</div>
                                    <div class="post-date">
                                    ` + data.data.date + `
                                    </div>
                                  </div>
                                </div>
                                <a href="#" class="more-option">
                                  <svg
                                    width="37"
                                    height="37"
                                    viewBox="0 0 37 37"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <circle
                                      cx="18.5"
                                      cy="18.5"
                                      r="18.5"
                                      fill="#EDF2F6"
                                    />
                                    <path
                                      d="M15.2857 17.0714V19.2143C15.2857 19.8058 14.8058 20.2857 14.2143 20.2857H12.0714C11.4799 20.2857 11 19.8058 11 19.2143V17.0714C11 16.4799 11.4799 16 12.0714 16H14.2143C14.8058 16 15.2857 16.4799 15.2857 17.0714ZM21 17.0714V19.2143C21 19.8058 20.5201 20.2857 19.9286 20.2857H17.7857C17.1942 20.2857 16.7143 19.8058 16.7143 19.2143V17.0714C16.7143 16.4799 17.1942 16 17.7857 16H19.9286C20.5201 16 21 16.4799 21 17.0714ZM26.7143 17.0714V19.2143C26.7143 19.8058 26.2344 20.2857 25.6429 20.2857H23.5C22.9085 20.2857 22.4286 19.8058 22.4286 19.2143V17.0714C22.4286 16.4799 22.9085 16 23.5 16H25.6429C26.2344 16 26.7143 16.4799 26.7143 17.0714Z"
                                      fill="#C0C0C0"
                                    />
                                  </svg>
                                </a>
                              </div>
                              <div class="post__dec">
                              ` + data.data.post + `
                              </div>
                              <div class="post__thamp-img">
                                <img src="` + base_url + `/spirit-books//` + data.data.post_image + `" alt="" />
                              </div>
                              <div class="post__react flex">
                                <div class="likes flex likePost" data-id="` + data.data.id + `" data-community="` +
                    data.data.community_id + `">
                                  <svg
                                  id="postLikeIcon` + data.data.id + `"
                                    width="30"
                                    height="28"
                                    viewBox="0 0 30 28"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M21.406 25.9996H24.9349C25.6829 26.0116 26.4098 25.7738 26.9774 25.3314C27.5451 24.889 27.9141 24.2727 28.0144 23.5996V15.1998C27.9141 14.5266 27.5451 13.9104 26.9774 13.468C26.4098 13.0256 25.6829 12.7878 24.9349 12.7998H21.406M12.1541 10.3998V5.59994C12.1541 4.64517 12.5719 3.72952 13.3155 3.0544C14.059 2.37928 15.0676 2 16.1192 2L21.406 12.7998V25.9996H6.49726C5.85977 26.0061 5.24115 25.8033 4.75539 25.4284C4.26963 25.0535 3.94946 24.5319 3.85387 23.9596L2.02993 13.1598C1.97243 12.8158 1.99798 12.4646 2.10482 12.1305C2.21166 11.7964 2.39723 11.4874 2.64867 11.2249C2.90012 10.9623 3.21142 10.7526 3.56102 10.6101C3.91062 10.4677 4.29015 10.3959 4.67332 10.3998H12.1541Z"
                                      stroke="#C0C0C0"
                                      stroke-width="3"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    />
                                  </svg>
                                  <span class="like-num" id="postLikeCount` + data.data.id + `"> 0</span>
                                </div>
                                <div class="dis_likes flex dislikePost" data-id="` + data.data.id +
                    `" data-community="` + data.data.community_id + `">
                                  <svg
                                  id="postdislikeIcon` + data.data.id + `"
                                    width="30"
                                    height="28"
                                    viewBox="0 0 30 28"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M20.906 2.00043H24.4349C25.1829 1.98842 25.9098 2.22619 26.4774 2.6686C27.0451 3.11102 27.4141 3.72727 27.5144 4.40039V12.8002C27.4141 13.4734 27.0451 14.0896 26.4774 14.532C25.9098 14.9744 25.1829 15.2122 24.4349 15.2002H20.906M11.6541 17.6002V22.4001C11.6541 23.3548 12.0719 24.2705 12.8155 24.9456C13.559 25.6207 14.5676 26 15.6192 26L20.906 15.2002V2.00043H5.99726C5.35977 1.99389 4.74115 2.19674 4.25539 2.57162C3.76963 2.94649 3.44946 3.46812 3.35387 4.0404L1.52993 14.8402C1.47243 15.1842 1.49798 15.5354 1.60482 15.8695C1.71166 16.2036 1.89723 16.5126 2.14867 16.7751C2.40012 17.0377 2.71142 17.2474 3.06102 17.3899C3.41062 17.5323 3.79015 17.6041 4.17332 17.6002H11.6541Z"
                                      stroke="#C0C0C0"
                                      stroke-width="3"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    />
                                  </svg>
                                  <span class="dislikes-num" id="postdisLikeCount` + data.data.id + `"> 0 </span>
                                </div>


                                <div class="comment flex">
                                  <svg
                                    width="31"
                                    height="27"
                                    viewBox="0 0 31 27"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M9.4375 10.9375C8.38281 10.9375 7.5625 11.8164 7.5625 12.8125C7.5625 13.8672 8.38281 14.6875 9.4375 14.6875C10.4336 14.6875 11.3125 13.8672 11.3125 12.8125C11.3125 11.8164 10.4336 10.9375 9.4375 10.9375ZM16 10.9375C14.9453 10.9375 14.125 11.8164 14.125 12.8125C14.125 13.8672 14.9453 14.6875 16 14.6875C16.9961 14.6875 17.875 13.8672 17.875 12.8125C17.875 11.8164 16.9961 10.9375 16 10.9375ZM22.5625 10.9375C21.5078 10.9375 20.6875 11.8164 20.6875 12.8125C20.6875 13.8672 21.5078 14.6875 22.5625 14.6875C23.5586 14.6875 24.4375 13.8672 24.4375 12.8125C24.4375 11.8164 23.5586 10.9375 22.5625 10.9375ZM16 0.625C7.67969 0.625 1 6.13281 1 12.8125C1 15.625 2.11328 18.2031 4.04688 20.2539C3.22656 22.5391 1.41016 24.5312 1.35156 24.5312C0.941406 24.9414 0.882812 25.5273 1.05859 26.0547C1.29297 26.582 1.82031 26.875 2.40625 26.875C5.98047 26.875 8.85156 25.4102 10.5508 24.1797C12.25 24.707 14.0664 25 16 25C24.2617 25 31 19.5508 31 12.8125C31 6.13281 24.2617 0.625 16 0.625ZM16 22.1875C14.418 22.1875 12.8359 21.9531 11.3711 21.4844L10.0234 21.0742L8.91016 21.8945C8.08984 22.4805 6.91797 23.125 5.51172 23.5938C5.98047 22.8906 6.39062 22.0703 6.68359 21.25L7.32812 19.6094L6.09766 18.3203C5.04297 17.207 3.8125 15.332 3.8125 12.8125C3.8125 7.65625 9.26172 3.4375 16 3.4375C22.6797 3.4375 28.1875 7.65625 28.1875 12.8125C28.1875 18.0273 22.6797 22.1875 16 22.1875Z"
                                      fill="#C0C0C0"
                                    />
                                  </svg>
                                  <span class="comment-num" id="postCommentsCount` + data.data.id + `"> 0</span>
                                </div>
                              </div>
                              <div class="body_comment"  id="commentSection` + data.data.id + `">
                                    </div>
                              <div class="comments_input flex">
                                <img src="{{ asset('public/frontend_asset') }}/imgs/commets.png" alt="" />
                                <input
                                  type="text"
                                  placeholder="Write your comment"
                                  class="writeComment" data-id="` + data.data.id + `" data-community="` + data.data
                    .community_id + `"
                                />
                              </div>
                            </div>`;

                $("#latestPost").append(newPost);

                // $("#notification").append('<div class="alert alert-success">'+i+'.'+data.data.title+'</div>');
            });


        // Comments


        window.Echo.channel('comments-channel')
            .listen('.CommentsEvent', (data) => {

                console.log(data);

                let newComments = `     <div class="row">
                                    <ul id="list_comment" class="col-md-12">
                                        <!-- Start List Comment 1 -->
                                        <li class="box_result row">
                                            <div class="avatar_comment col-md-1">
                                                <img src="` + data.data.user_profile_picture + `" alt="avatar" />
                                            </div>
                                            <div class="result_comment col-md-11">
                                                <h4>
                                                    ` + data.data.user_name + `
                                                </h4>
                                                <p>
                                                    ` + data.data.comment + `
                                                </p>
                                                <div class="tools_comment">
                                                    <a class="like" href="#">Like</a>
                                                    <span aria-hidden="true">
                                                        ·
                                                    </span>

                                                    <span aria-hidden="true">
                                                        ·
                                                    </span>
                                                    <span>` + data.data.date + `</span>
                                                </div>



                                            </div>
                                        </li>

                                        </li>
                                    </ul>
                                </div>`;

                $("#commentSection" + data.data.post_id).append(newComments);
                $('#postCommentsCount' + data.data.post_id).text(data.data.total_comments);

                // $("#notification").append('<div class="alert alert-success">'+i+'.'+data.data.title+'</div>');
            });


        $("#add_post_form").submit(function(e) {
            e.preventDefault();
            showCalimaticLoader();
            $(".error_msg").html('');
            var data = new FormData($('#add_post_form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('community-submit-post') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    $("#showMessage").text("Message has ben successfully send.");
                    location.reload();
                }
            }).fail(function(data, textStatus, jqXHR) {
                //console.log(data);
                //console.log(textStatus);
                var json_data = JSON.parse(data.responseText);
                //console.log(json_data.errors);
                $.each(json_data.errors, function(key, value) {
                    console.log(value);
                    $("#errorMessage").text(value);
                    $("#" + key).after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });
            HideCalimaticLoader();
        });


        $(document).on("click", ".likePost", function(e) {
            e.preventDefault();
            showCalimaticLoader();
            let postId = $(this).data("id");
            let communityId = $(this).data("community");
            // alert($(this).data("id"));
            $(".error_msg").html('');


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('community-submit-like-post') }}",
                data: {
                    post_id: postId,
                    community_id: communityId
                },
                // cache: false,
                // contentType: false,
                // processData: false,
                success: function(data, textStatus, jqXHR) {
                    // $("#showMessage").text("Message has ben successfully send.");
                    if (data.status == 'Liked') {
                        $("#postLikeIcon" + data.data.post_id).css({
                            fill: 'blue'
                        });
                        $("#postdislikeIcon" + data.data.post_id).css({
                            fill: 'none'
                        });

                        let currentCount = $('#postdisLikeCount' + data.data.post_id).text();
                        if (parseInt(currentCount) > 0) {
                            $('#postdisLikeCount' + data.data.post_id).text(parseInt(currentCount) - 1);
                        }


                    } else if (data.status == 'DisLiked') {
                        // alert();
                        $("#postLikeIcon" + data.data.post_id).css({
                            fill: 'none'
                        });
                    }

                    $('#postLikeCount' + data.data.post_id).text(data.total_likes);
                }
            }).fail(function(data, textStatus, jqXHR) {
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    //                console.log(key);
                    $("#" + key).after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });
            HideCalimaticLoader();
        });

        // $(".likePost").on('click',function (e){
        //     e.preventDefault();
        //     showCalimaticLoader();
        //     let postId = $(this).data("id");
        //     let communityId = $(this).data("community");
        //     // alert($(this).data("id"));
        //     $(".error_msg").html('');


        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         method: "POST",
        //         url: "{{ url('community-submit-like-post') }}",
        //         data: {post_id:postId,community_id:communityId},
        //         // cache: false,
        //         // contentType: false,
        //         // processData: false,
        //         success: function (data, textStatus, jqXHR) {
        //             // $("#showMessage").text("Message has ben successfully send.");
        //             if(data.status == 'Liked'){
        //               $("#postLikeIcon"+data.data.post_id).css({ fill: 'blue'});
        //             }else if(data.status == 'DisLiked'){
        //               // alert();
        //               $("#postLikeIcon"+data.data.post_id).css({ fill: 'none'});
        //             }

        //             $('#postLikeCount'+data.data.post_id).text(data.total_likes);
        //         }
        //     }).fail(function(data, textStatus, jqXHR) {
        //         var json_data = JSON.parse(data.responseText);
        //         $.each(json_data.errors, function(key, value){
        // //                console.log(key);
        //             $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
        //         });
        //     });
        //     HideCalimaticLoader();
        // });

        $(document).on("click", ".dislikePost", function(e) {
            e.preventDefault();
            showCalimaticLoader();
            let postId = $(this).data("id");
            let communityId = $(this).data("community");
            // alert($(this).data("id"));
            $(".error_msg").html('');


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('community-submit-dislike-post') }}",
                data: {
                    post_id: postId,
                    community_id: communityId
                },
                // cache: false,
                // contentType: false,
                // processData: false,
                success: function(data, textStatus, jqXHR) {
                    // $("#showMessage").text("Message has ben successfully send.");
                    if (data.status == 'DisLiked') {
                        $("#postdislikeIcon" + data.data.post_id).css({
                            fill: 'blue'
                        });
                        $("#postLikeIcon" + data.data.post_id).css({
                            fill: 'none'
                        });
                        let currentCount = $('#postLikeCount' + data.data.post_id).text();
                        if (parseInt(currentCount) > 0) {
                            $('#postLikeCount' + data.data.post_id).text(parseInt(currentCount) - 1);
                        }
                    } else if (data.status == 'Liked') {
                        // alert();
                        $("#postdislikeIcon" + data.data.post_id).css({
                            fill: 'none'
                        });

                    }

                    $('#postdisLikeCount' + data.data.post_id).text(data.total_likes);
                }
            }).fail(function(data, textStatus, jqXHR) {
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    //                console.log(key);
                    $("#" + key).after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });
            HideCalimaticLoader();
        });


        // $(document).on("keypress", ".writeComment" , function(e) {
        //     e.preventDefault();
        //     // showCalimaticLoader();
        //     let postId = $(this).data("id");
        //     let communityId = $(this).data("community");
        //     if(e.which == 13) {
        //         // alert('You pressed enter!');

        //         $(".error_msg").html('');


        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     method: "POST",
        //     url: "{{ url('community-submit-comment-post') }}",
        //     data: {post_id:postId,community_id:communityId},
        //     // cache: false,
        //     // contentType: false,
        //     // processData: false,
        //     success: function (data, textStatus, jqXHR) {

        //         // $("#showMessage").text("Message has ben successfully send.");
        //         // if(data.status == 'DisLiked'){
        //         //   $("#postdislikeIcon"+data.data.post_id).css({ fill: 'blue'});
        //         //   $("#postLikeIcon"+data.data.post_id).css({ fill: 'none'});
        //         //   let currentCount = $('#postLikeCount'+data.data.post_id).text();
        //         //  if(parseInt(currentCount) > 0){
        //         //   $('#postLikeCount'+data.data.post_id).text(parseInt(currentCount) - 1);
        //         //  }
        //         // }else if(data.status == 'Liked'){
        //         //   // alert();
        //         //   $("#postdislikeIcon"+data.data.post_id).css({ fill: 'none'});

        //         // }

        //         // $('#postdisLikeCount'+data.data.post_id).text(data.total_likes);
        //     }
        // }).fail(function(data, textStatus, jqXHR) {
        //     var json_data = JSON.parse(data.responseText);
        //     $.each(json_data.errors, function(key, value){
        // //                console.log(key);
        //         $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
        //     });
        // });
        // // HideCalimaticLoader();
        //     }
        //     // alert(postId);
        //     // alert($(this).data("id"));

        // });

        $(document).on("keypress", ".writeComment", function(e) {
            // e.preventDefault();
            // showCalimaticLoader();
            let postId = $(this).data("id");
            let comment = $(this).val();
            let communityId = $(this).data("community");
            if (e.which == 13) {
                $(this).val('');
                // alert(postId);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "{{ url('community-submit-comment-post') }}",
                    data: {
                        post_id: postId,
                        community_id: communityId,
                        comment: comment
                    },
                    success: function(data, textStatus, jqXHR) {

                    }
                }).fail(function(data, textStatus, jqXHR) {
                    var json_data = JSON.parse(data.responseText);
                    $.each(json_data.errors, function(key, value) {
                        //                console.log(key);
                        $("#" + key).after(
                            "<span class='error_msg' style='color: red;font-weigh: 600'>" +
                            value + "</span>");
                    });
                });
                location.reload();
                // HideCalimaticLoader();
            }


        });
    </script>
    <script>
        function followAuthor(authorId) {
            $('.loader').show();
            $(".error_msg").html('');
            var data = new FormData($('#add_form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('follow-author') }}",
                data: {
                    author_id: authorId
                },
                success: function(data, textStatus, jqXHR) {
                    if (data.status == 1) {
                        $('#author' + authorId).text('Follwing');
                    }

                }
            }).done(function() {

                $("#success_msg").html("Data Save Successfully");

                //  window.location.href = "{{ url('admin/users') }}";
                // location.reload();
            }).fail(function(data, textStatus, jqXHR) {
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" +
                        value + "</span>");
                });
            });
            $('.loader').hide();
        }

        function UnfollowAuthor(Id) {
            $('.loader').show();
            $(".error_msg").html('');
            var data = new FormData($('#add_form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('unfollow-author') }}",
                data: {
                    id: Id
                },
                success: function(data, textStatus, jqXHR) {
                    if (data.status == 1) {

                        $('#followingAuthor' + Id).text('Follow');
                    }

                }
            }).done(function() {
                $("#success_msg").html("Data Save Successfully");
                //  window.location.href = "{{ url('admin/users') }}";
                // location.reload();
            }).fail(function(data, textStatus, jqXHR) {
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" +
                        value + "</span>");
                });
            });
            $('.loader').hide();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmCancellation(event) {
            event.preventDefault(); // Prevent the default action of the link

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks "Yes," proceed with the cancellation
                    window.location.href = "{{ url('author/delete-community/' . $community->id) }}";
                }
            });
        }
    </script>

    <script>
        document.getElementById('add_post_form').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent the default form submission
                // You can add additional logic here if needed
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var postInput = document.getElementById('postInput');
            var postButton = document.getElementById('postButton');
            var charCountElement = document.getElementById('charCount');

            postInput.addEventListener('input', function() {
                var charCount = postInput.value.length;
                charCountElement.textContent = charCount;

                if (charCount > 100) {
                    postButton.disabled = true;
                } else {
                    postButton.disabled = false;
                }
            });
        });
    </script>

@endsection
