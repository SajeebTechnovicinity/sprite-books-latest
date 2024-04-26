<!-- Content Block -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" />
<section class="body-content alt-content book-details">
    <div class="container">
        <div class="inner-content">
            <div class="tab-panel">

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
                                    <label for="isbn" class="label">Role*</label>
                                    <input type="radio" value="Publisher" name="author_define" required>
                                    <label for="html">Publisher</label>
                                    <input type="radio" value="Author" name="author_define" required>
                                    <label for="html">Author</label>
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
                                    <input type="text" name="book_name" id="title" class="input" />
                                </div>

                                <div class="form-field">
                                    <label for="dsc" class="label">Book Description*</label>
                                    <textarea name="book_description" id="dsc" class="textarea"></textarea>
                                </div>

                                <div class="form-field">
                                    <label for="dsc" class="label">Select Genre*</label>
                                    <select class="input form-control" name="genere_id">
                                        @foreach ($generes as $row)
                                            <option value="{{ $row->id }}">{{ $row->genere_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="links" class="label">Book Amazon Links*</label>
                                        <input type="text" name="book_amazon_link" id="links" class="input" />
                                    </div>

                                </div>


                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="links" class="label">Book Ebay Links*</label>
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
                                        <input type="text" name="book_discount_in_percentage" class="input"
                                            placeholder="" pattern="\d+(\.\d+)?" title="Enter a valid number" />
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
                                        <input type="text" name="hard_book_price" class="input"
                                            pattern="\d+(\.\d+)?" placeholder="HardBook" />
                                    </div>
                                    <div class="form-field">
                                        <label class="label">Ebook Price</label>
                                        <input type="text" name="ebook_price" class="input"
                                            pattern="\d+(\.\d+)?" placeholder="Ebook" />
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
                                        Attach File*
                                    </label>
                                    <input class="attach-input" type="file" name="file_updoad" id="attach-file"
                                        accept="image/*" required />
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
                                            Attach Video (Max 10 MB)*
                                        </label>
                                        <input class="attach-input" type="file" name="video_file_updoad"
                                            id="attach-file1" accept="video/*" required />
                                    </div> --}}

                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="links" class="label">Video Link</label>
                                        <input type="text" name="video_file_updoad" id="links"
                                            class="input" />
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
                @if (session('type') != 'USER')
                    @if (check_user_max_book_by_user_id(session('author_id')) == 1)
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

            <div class="tab-content">
                <!-- Breadcrumb -->
                {{-- <ul class="breadcrumb">
                        <li class="breadcrumb__item">
                            <a href="#" class="breadcrumb__link">Feed</a>
                            <span class="separator">/</span>
                        </li>
                        <li class="breadcrumb__item">
                            <a href="#" class="breadcrumb__link">Popular
                            </a>
                            <span class="separator">/</span>
                        </li>
                        <li class="breadcrumb__item">
                            <a href="#" class="breadcrumb__link">Library
                            </a>
                            <span class="separator">/</span>
                        </li>
                        <li class="breadcrumb__item">In Code</li>
                    </ul> --}}
                <!-- Content Block -->
                <div class="block-wrap">
                    <div class="block-component">
                        <div class="media">
                            <div class="main-figure-group">
                                @foreach ($book->bookDocuments as $row)
                                    <figure class="figure main-figure">
                                        <img src="{{ asset($row->path) }}" alt="" />
                                    </figure>
                                @endforeach

                            </div>
                            <div class="figure-guoup">
                                @foreach ($book->bookDocuments as $row1)
                                    <figure class="figure">
                                        <img src="{{ asset($row1->path) }}" alt="" />
                                    </figure>
                                @endforeach
                            </div>
                        </div>
                        <div class="block-content">
                            <h5 class="subtitle">{{ $book->Genere->genere_name }}</h5>
                            <h2 class="title">{{ $book->book_name }}</h2>
                            <div class="block-content__row">
                                <div class="user">
                                    <img class="user__img" height="60px" width="60px"
                                        src="@if ($book->bookAuthor->author_profile_picture) {{ asset($book->bookAuthor->author_profile_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile.jpg @endif"
                                        alt="" />
                                    <h5 class="user__name">
                                        {{ $book->bookAuthor->author_name }}
                                    </h5>
                                </div>
                                {{-- <div class="ratting-wrap">
                                        <ul class="ratting">
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                        </ul>
                                        <ul class="ratting active-ratting" style="width: 70%">
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.58918 0.560293C3.74708 0.117598 4.37315 0.117599 4.53106 0.560294L5.05079 2.01739C5.1218 2.21649 5.31035 2.34941 5.52173 2.34941H7.0969C7.59247 2.34941 7.78612 2.99286 7.37285 3.26637L6.18122 4.05503C5.98943 4.18196 5.90897 4.42334 5.98623 4.63996L6.45986 5.96781C6.62129 6.42039 6.11366 6.81794 5.71297 6.55275L4.33607 5.64147C4.16876 5.53074 3.95147 5.53074 3.78416 5.64147L2.40726 6.55275C2.00657 6.81794 1.49895 6.42038 1.66037 5.96781L2.134 4.63996C2.21127 4.42334 2.1308 4.18196 1.93902 4.05503L0.74738 3.26637C0.334119 2.99286 0.527761 2.34941 1.02333 2.34941H2.59851C2.80989 2.34941 2.99843 2.21649 3.06945 2.01739L3.58918 0.560293Z"
                                                        fill="#3E3E3E" />
                                                </svg>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="text-gray ratting-poing">
                                        5.0
                                    </p> --}}
                                {{-- <p class="text-gray divider">|</p>
                                    <p class="text-gray status">100 sold</p> --}}
                            </div>
                            <div class="block-content__row">
                                <span class="unique-no">ISBN : {{ $book->isbn }}</span>
                                {{-- <span class="unique-no">ISBN : 9785041286736</span> --}}
                            </div>
                            <h3 class="totoal-price">
                                ${{ $book->book_price }}<span
                                    class="savings">{{ $book->book_discount_in_percentage }}% OFF</span>
                            </h3>
                            <div class="block-content__row category">
                                <div class="category__item">
                                    <p class="label">Hardcover</p>
                                    <p class="price">$ {{ $book->hard_book_price }}</p>
                                </div>
                                <div class="category__item">
                                    <p class="label">Ebook</p>
                                    <p class="price">${{ $book->ebook_price }}</p>
                                </div>

                            </div>
                            <div class="block-content__row buy-buttons-group">
                                {{-- <form class="quantity-form btn">
                                        <span class="decrement">-</span>
                                        <input type="text" class="quantity-field" value="1" />
                                        <span class="increment">+</span>
                                    </form> --}}
                                <a href="{{ $book->book_amazon_link }}" target="__blank">Buy in Amazon</a>
                                <a href="{{ $book->book_ebay_link }}" target="__blank">Buy in Ebay</a>
                                <a href="#." class="share-btn" onclick="showShareButton()">
                                    <!-- <span class="icon">
                                                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M0.533333 13.9995C0.492667 13.9995 0.4516 13.9948 0.410933 13.9854C0.170267 13.9275 0 13.7108 0 13.4611C0 8.56822 0.613067 4.49891 8 4.31382V0.538376C8 0.324344 8.12547 0.130907 8.31933 0.0451597C8.51253 -0.0400493 8.73907 -0.00316585 8.89533 0.143022L15.8287 6.60437C15.938 6.70573 16 6.84936 16 6.99972C16 7.15008 15.938 7.29372 15.8287 7.39521L8.89533 13.8566C8.7396 14.0027 8.51307 14.0406 8.31933 13.9544C8.12547 13.8685 8 13.6751 8 13.4611V9.69828C2.9328 9.82078 1.99787 11.708 1.0104 13.7019C0.9188 13.8875 0.731733 13.9995 0.533333 13.9995ZM8.53333 8.61506C8.82813 8.61506 9.06667 8.85588 9.06667 9.15351V12.2311L14.6803 6.99972L9.06667 1.76832V4.84594C9.06667 5.14357 8.82813 5.38439 8.53333 5.38439C2.6416 5.38439 1.37293 7.6849 1.12347 11.3594C2.22813 9.86129 4.11093 8.61506 8.53333 8.61506Z"
                                                                    fill="black" />
                                                            </svg>
                                                        </span> -->
                                    Share</a>
                                <div style="display: none" id="shareButtons">
                                    <a href="#" class="review-btn">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                            target="_blank">
                                            Share on Facebook
                                        </a>

                                        <a class="twitter-share-button"
                                            href="https://twitter.com/share?url={{ url()->current() }}"
                                            target="__blank">
                                            Tweet</a>
                                    </a>
                                </div>
                            </div>
                            <div class="ensure-text block-content__row">
                                <p class="para">
                                    <span class="icon">
                                        <svg width="21" height="18" viewBox="0 0 21 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.8348 17.9999L11.7739 10.4657L15.3242 10.4362L15.3925 17.9778L13.6912 16.7581L11.8348 17.9999Z"
                                                fill="#FCC71B" />
                                            <path
                                                d="M16.1511 10.7352C15.413 9.79406 14.0032 9.77746 13.7061 9.77376C13.1957 9.75028 12.6877 9.85695 12.2299 10.0838C11.8528 10.2711 11.5181 10.5336 11.2463 10.8551C10.0709 12.2723 11.2463 13.7706 10.2591 15.1749C9.33647 16.4887 7.41 16.5625 7.14243 16.5662C5.98175 16.5755 4.321 16.0994 3.65302 14.7468C3.45262 14.3366 3.34968 13.8857 3.35224 13.4293C1.80405 13.1617 0.81498 11.7464 1.02903 10.427C1.20249 9.37334 2.12513 8.49499 3.31164 8.31046C3.31164 8.28647 3.31164 8.25326 3.31164 8.21266C3.3264 7.93218 3.38545 6.85085 4.11064 6.10536C4.96132 5.23438 6.2161 5.34879 6.38587 5.36724C6.55748 2.86874 8.81425 0.942273 11.3847 1.00132C13.8279 1.06591 15.8983 2.91303 16.092 5.28236C16.9036 5.28013 17.6872 5.57858 18.2916 6.12012C18.578 6.38127 18.8077 6.6985 18.9664 7.05211C19.1251 7.40573 19.2095 7.78819 19.2142 8.17576C19.2142 9.28292 19.2204 10.3901 19.2327 11.4973C19.255 11.6886 19.2393 11.8825 19.1864 12.0678C19.1335 12.253 19.0445 12.426 18.9245 12.5767C18.4226 13.1488 17.4317 13.1303 16.9187 12.7317C16.3042 12.2575 16.7766 11.5415 16.1511 10.7352Z"
                                                stroke="#3E3E3E" stroke-width="2" stroke-miterlimit="10" />
                                        </svg> </span>SpiritBooks Guarantee
                                </p>
                                <p class="para">
                                    <span class="icon">
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_954_845)">
                                                <path
                                                    d="M7.5 0C3.36433 0 0 3.36433 0 7.5C0 11.6357 3.36433 15 7.5 15C11.6357 15 15 11.6357 15 7.5C15 3.36433 11.6357 0 7.5 0ZM11.3013 5.91064L7.23873 9.97307C7.11685 10.0949 6.95686 10.1563 6.79688 10.1563C6.63689 10.1563 6.4769 10.0949 6.35502 9.97307L4.32381 7.94186C4.07936 7.69753 4.07936 7.30247 4.32381 7.05814C4.56814 6.8137 4.96307 6.8137 5.20752 7.05814L6.79688 8.6475L10.4176 5.02693C10.6619 4.78249 11.0568 4.78249 11.3013 5.02693C11.5456 5.27126 11.5456 5.6662 11.3013 5.91064Z"
                                                    fill="#3E3E3E" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_954_845">
                                                    <rect width="15" height="15" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg> </span>Verified Author
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-wrap">
                        <div class="tabs-btns-row">
                            <a href="#book-dsc" class="tab-btn btn-active">
                                Book Description</a>
                            <a href="#author-details" class="tab-btn">
                                Author Details</a>
                            <a href="#media" class="tab-btn">Media</a>
                            {{-- <a href="#reviews" class="tab-btn">Reviews (1900)
                                </a> --}}
                        </div>
                        <div class="tab-body">
                            <div class="tab-body__inner" id="book-dsc">
                                <p class="dsc">
                                    {{ $book->book_description }}
                                </p>
                            </div>
                            <div class="tab-body__inner author-details-body d-none" id="author-details">
                                <div class="author-info">
                                    <div class="author-info__row">
                                        <div class="profile-img">
                                            <img src="@if ($book->bookAuthor->author_profile_picture) {{ asset($book->bookAuthor->author_profile_picture) }} @else {{ asset('public/frontend_asset') }}/imgs/profile.jpg @endif"
                                                alt="" />
                                        </div>
                                        <div class="author-name">
                                            <h2 class="name">
                                                {{ $book->bookAuthor->author_name }}
                                            </h2>
                                            <p class="tagname">
                                                Author
                                            </p>
                                        </div>
                                    </div>
                                    <!-- <div class="row-wrap"> -->
                                    <div class="author-info__row">
                                        <div class="item">
                                            <p class="item__label">
                                                Books
                                            </p>
                                            <h2 class="item__no">
                                                {{ get_author_total_books_count_by_author_id($book->bookAuthor->id) }}
                                            </h2>
                                        </div>
                                        <div class="item">
                                            <p class="item__label">
                                                Followers
                                            </p>
                                            <h2 class="item__no">
                                                {{ get_author_total_followers_count_by_author_id($book->bookAuthor->id) }}
                                            </h2>
                                        </div>
                                        {{-- <div class="item">
                                                <p class="item__label">
                                                    Rating
                                                </p>
                                                <h2 class="item__no">
                                                    4.5
                                                </h2>
                                            </div> --}}
                                    </div>
                                    <div class="author-info__row links">
                                        <a href="{{ url('author-events/' . $book->bookAuthor->id) }}"
                                            class="link">Events</a>
                                        @if ($book->bookAuthor->id == session('author_id'))
                                            <a href="#." class="link solid-btn"
                                                onclick="alert('You can not follow yourself !')">Follow</a>
                                        @else
                                            <a href="#." class="link solid-btn followAuthorNow"
                                                id="author{{ session('author_id') }}_{{ $book->bookAuthor->id }}"
                                                data-user="@if (session('type') == 'USER') {{ session('author_id') }} @endif"
                                                data-author="{{ $book->bookAuthor->id }}">Follow</a>
                                        @endif
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="author-dsc">
                                    <p class="dsc">
                                        {{ $book->bookAuthor->author_description }}
                                    </p>
                                </div>
                            </div>
                            <div class="tab-body__inner media d-none" id="media">
                                @foreach ($book->bookDocuments as $bookDocs)
                                    <figure class="media-item image">
                                        <a href="{{ url('book-details/' . $row1->id) }}">
                                            @if ($bookDocs->type == 'IMAGE')
                                                <img src="{{ asset($bookDocs->path ?? '') }}" alt="" />
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
                                {{-- <a href="#" class="media__item video space-bottom">
                                        <img src="{{asset('public/frontend_asset')}}/imgs/placeholder-11.png" alt="" />
                                        <span class="icon">
                                            <svg width="58" height="58" viewBox="0 0 58 58" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="29" cy="29" r="28.5" stroke="#3E3E3E" />
                                                <path
                                                    d="M40 26.7679C41.3333 27.5378 41.3333 29.4623 40 30.2321L24.25 39.3253C22.9167 40.0951 21.25 39.1329 21.25 37.5933L21.25 19.4067C21.25 17.8671 22.9167 16.9049 24.25 17.6747L40 26.7679Z"
                                                    fill="#656565" />
                                            </svg>
                                        </span>
                                        <div class="video__text">
                                            <p class="text">
                                                Jane Doe Prologue : In Code
                                            </p>
                                        </div>
                                    </a>
                                    <figure class="media__item figure">
                                        <img src="{{asset('public/frontend_asset')}}/imgs/placeholder-19.png" alt="" />
                                    </figure>
                                    <figure class="media__item figure">
                                        <img src="{{asset('public/frontend_asset')}}/imgs/placeholder-19.png" alt="" />
                                    </figure> --}}
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Grid Items -->
                <div class="grid-container author-inheritance">
                    <div class="title-bar flex-equal">
                        <h3 class="title">From the same Author</h3>
                    </div>
                    <div class="grid-items">
                        @if ($author_books->isNotEmpty())
                            @foreach ($author_books as $sBooks)
                                <div class="card grid-item">
                                    @if (isset($sBooks->bookDocuments[0]))
                                        <a href="{{ url('book-details/' . $sBooks->id) }}" class="figure">
                                            <img src="{{ asset($sBooks->bookDocuments[0]->path) }}" alt="" />
                                        </a>
                                    @endif
                                    <div class="text-wrap">
                                        <h5 class="subtitle">PAPERBACK</h5>
                                        <a href="{{ url('book-details/' . $sBooks->id) }}"
                                            class="title">{{ $sBooks->book_name }}</a>

                                        <?php
                                        $text = $sBooks->book_description;
                                        if (strlen($text) > 30) {
                                            $firstPara = substr($text, 0, strpos($text, ' ', 30));
                                            $countLength = strlen($firstPara);
                                            $secondPara = substr($text, strpos($text, true) + $countLength);
                                        } else {
                                            $firstPara = $row->book_description ?? '';
                                        }
                                        ?>

                                        <p class="para">
                                            <span class="main">
                                                {{ $firstPara }}}
                                            </span>
                                            @if (strlen($text) > 30)
                                                <span class="extended">
                                                    {{ $secondPara }}
                                                </span>
                                                <span class="read-more">Show More</span>
                                            @endif
                                        </p>

                                        {{-- <p class="dsc">
                                        {{Illuminate\Support\Str::of($sBooks->book_description ?? '')->words(10, ' ...')}}
                                    </p> --}}

                                        {{-- <span class="ratting-poing">8.9</span> --}}
                                        <a href="{{ url('book-details/' . $sBooks->id) }}" class="card-link">View
                                            Details</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h5 class="title">No other books available</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script>
    function showShareButton() {
        $('#shareButtons').show();
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

   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
    <script>
        $(function() {
            $('#editor').summernote({
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
