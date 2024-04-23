@extends('master')

@section('content')
    <style>
        .hidden {
            display: none;
        }
    </style>
    <!-- Content Block -->
    <section class="body-content alt-content book-details">
        <div class="container">
            <div class="inner-content">
                <div class="book-search-wrap">
                    <!-- Content Block -->
                    <div class="book-search">
                        <div class="block-component">

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
                                                        <option value="{{ $listA->id }}">{{ $listA->author_name }}
                                                        </option>
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
                                                    <input type="text" name="book_amazon_link" id="links"
                                                        class="input" />
                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="form-field">
                                                    <label for="links" class="label">Book Ebay Links*</label>
                                                    <input type="text" name="book_ebay_link" id="links"
                                                        class="input" />
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
                                                    <input type="text" name="book_price" class="input"
                                                        pattern="\d+(\.\d+)?" placeholder="Price" required />
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
                                                        <svg width="22" height="22" viewBox="0 0 22 22"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.15059 20.0324C7.01751 20.0324 5.90988 19.6965 4.96775 19.067C4.02561 18.4375 3.29128 17.5428 2.85762 16.496C2.42395 15.4492 2.31042 14.2973 2.53138 13.186C2.75235 12.0747 3.29788 11.0539 4.09899 10.2526L11.3911 2.96041C12.1649 2.18803 13.2137 1.75443 14.3069 1.75488C15.4002 1.75533 16.4486 2.1898 17.2218 2.96281C17.9949 3.73582 18.4295 4.78415 18.4301 5.87743C18.4307 6.97072 17.9973 8.01953 17.225 8.79342L10.9051 15.1134C10.4248 15.5719 9.78631 15.8278 9.12231 15.8278C8.4583 15.8278 7.81983 15.5719 7.33956 15.1134C6.86709 14.6405 6.60177 13.9994 6.60194 13.3309C6.60211 12.6624 6.86776 12.0214 7.34047 11.5488L12.0393 6.84908C12.1244 6.76397 12.2255 6.69646 12.3367 6.6504C12.4479 6.60433 12.567 6.58063 12.6874 6.58063C12.8078 6.58063 12.927 6.60433 13.0382 6.6504C13.1494 6.69646 13.2504 6.76397 13.3355 6.84908C13.4206 6.93419 13.4882 7.03524 13.5342 7.14644C13.5803 7.25764 13.604 7.37683 13.604 7.49719C13.604 7.61756 13.5803 7.73675 13.5342 7.84795C13.4882 7.95915 13.4206 8.06019 13.3355 8.1453L8.63669 12.8451C8.57284 12.9089 8.52218 12.9847 8.48762 13.0681C8.45306 13.1515 8.43528 13.2409 8.43528 13.3311C8.43528 13.4214 8.45306 13.5108 8.48762 13.5942C8.52218 13.6776 8.57284 13.7534 8.63669 13.8172C8.76767 13.9422 8.94174 14.0119 9.12278 14.0119C9.30381 14.0119 9.47788 13.9422 9.60886 13.8172L15.9289 7.49719C16.3579 7.06712 16.5989 6.48442 16.5989 5.87691C16.5989 5.2694 16.3579 4.6867 15.9289 4.25663C15.4924 3.83951 14.9119 3.60673 14.3081 3.60673C13.7044 3.60673 13.1239 3.83951 12.6874 4.25663L5.39522 11.5488C5.03349 11.9106 4.74657 12.3401 4.55083 12.8127C4.35509 13.2854 4.25436 13.792 4.2544 14.3036C4.25445 14.8152 4.35525 15.3218 4.55107 15.7944C4.74689 16.267 5.03388 16.6965 5.39566 17.0582C5.75744 17.4199 6.18693 17.7068 6.65959 17.9026C7.13226 18.0983 7.63886 18.199 8.15045 18.199C8.66205 18.199 9.16862 18.0982 9.64126 17.9023C10.1139 17.7065 10.5433 17.4195 10.9051 17.0577L16.5769 11.3868C16.662 11.3017 16.7631 11.2341 16.8743 11.1881C16.9855 11.142 17.1047 11.1183 17.225 11.1183C17.3454 11.1183 17.4646 11.142 17.5758 11.1881C17.687 11.2341 17.788 11.3017 17.8732 11.3868C17.9583 11.4719 18.0258 11.5729 18.0718 11.6841C18.1179 11.7953 18.1416 11.9145 18.1416 12.0349C18.1416 12.1552 18.1179 12.2744 18.0718 12.3856C18.0258 12.4968 17.9583 12.5979 17.8732 12.683L12.2013 18.354C11.6707 18.8878 11.0395 19.3111 10.3442 19.5992C9.64883 19.8873 8.90324 20.0346 8.15059 20.0324Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                    Attach File*
                                                </label>
                                                <input class="attach-input" type="file" name="file_updoad"
                                                    id="attach-file" accept="image/*" required />
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
                                                    <input type="text" name="meta_key" class="input" required/>
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

                            <nav>

                            </nav>
                        </div>

                        <div class="content-wrap">
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

                                    <!-- Grid Items -->
                                    <div class="grid-container author-inheritance">
                                        <div class="title-bar flex-equal" style="padding-top: 0; padding-bottom: 35px;">
                                            <h3 class="title">Books</h3>
                                        </div>
                                        <div class="grid-items card-wrap books-card">
                                            @if ($books->isNotEmpty())
                                                @foreach ($books as $sBooks)
                                                    <div class="card grid-item">
                                                        @if (isset($sBooks->bookDocuments[0]))
                                                            <a href="{{ url('book-details/' . $sBooks->id) }}"
                                                                class="figure">
                                                                <img src="{{ asset($sBooks->bookDocuments[0]->path) }}"
                                                                    alt="" />
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
                                                                    {{ $firstPara }}
                                                                </span>
                                                                @if (strlen($text) > 30)
                                                                    <span class="extended">
                                                                        {{ $secondPara }}
                                                                    </span>
                                                                    {{-- <span class="read-more">Show More</span> --}}
                                                                @endif
                                                            </p>

                                                            {{-- <p class="dsc">
                                        {{Illuminate\Support\Str::of($sBooks->book_description ?? '')->words(10, ' ...')}}
                                        </p> --}}

                                                            {{-- <span class="ratting-poing">8.9</span> --}}
                                                            <a href="{{ url('book-details/' . $sBooks->id) }}"
                                                                class="card-link">
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
@endsection
