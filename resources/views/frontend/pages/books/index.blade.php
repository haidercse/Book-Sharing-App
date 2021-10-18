@extends('frontend.layouts.master')

@section('frontend-title')
    Book Sharing App
@endsection


@section('main-content')

    <div class="main-content">

        <div class="top-body pt-4 pb-4">
        <div class="container">
            <div class="row">

            <div class="col-md-3">
                <div class="card card-body single-top-link" onclick="location.href='{{ route('login') }}'">
                <h4>Sign In</h4>
                <i class="fa fa-sign-in-alt"></i>
                <p>
                    Sign In To Start Sharing Your Books
                </p>
                </div> <!-- Single Item -->
            </div> <!-- Single Col -->

            <div class="col-md-3">
                <div class="card card-body single-top-link"  onclick="location.href='{{ route('register') }}'">
                <h4>Create New</h4>
                <i class="fa fa-user"></i>
                <p>
                    Create New Account
                </p>
                </div> <!-- Single Item -->
            </div> <!-- Single Col -->

            <div class="col-md-3">
                <div class="card card-body single-top-link">
                <h4>Borrow Book</h4>
                <i class="fa fa-cart-plus"></i>
                <p>
                    Borrow your needed books
                </p>
                </div> <!-- Single Item -->
            </div> <!-- Single Col -->

            <div class="col-md-3">
                <div class="card card-body single-top-link">
                <h4>Top Searched</h4>
                <i class="fa fa-search"></i>
                <p>
                    Top Searched Book Lists
                </p>
                </div> <!-- Single Item -->
            </div> <!-- Single Col -->

            </div>
        </div>
        </div> <!-- End Top Body Links -->


        <div class="book-list-sidebar">
        <div class="container">
            <div class="row">

            <div class="col-md-9">
                <h3>
                    @if (isset($searched))
                      Searched  Book  By - <mark>{{ $searched }} </mark>                   @else
                    Recent Uploaded Books
                    @endif
                </h3>



              @include('frontend.pages.books.partials.recent-upload')

                <div class="books-pagination mt-5">
                <nav aria-label="...">
                    <ul class="pagination">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">
                        2
                        <span class="sr-only">(current)</span>
                        </span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                    </ul>
                </nav>
                </div>

            </div> <!-- Book List -->

            <div class="col-md-3">
                <div class="widget">
                <h5 class="mb-2 border-bottom pb-3">
                    Categories
                </h5>

              @include(' frontend.pages.books.partials.category-sidebar')

                </div> <!-- Single Widget -->

            </div> <!-- Sidebar -->

            </div>
        </div>
        </div>

    </div>

@endsection
