@extends('frontend.layouts.master')

@section('frontend-title')
    Book View| Book Sharing App
@endsection


@section('main-content')
    <div class="main-content">
        <div class="book-show-area">
            <div class="container">
                @include('backend.layouts.partials.message')
                <div class="row">
                    <div class="col-md-3">

                    <img src="{{ asset('frontend/images/books/book.jpg')}}" class="img img-fluid" />
                    </div>

                    <div class="col-md-9">
                    <h3>Java Programming</h3>
                    <p class="text-muted">Written By
                        <span class="text-primary">Herbert Scheild</span> @<span class="text-info">Programming</span>
                    </p>
                    <hr>
                    <p><strong>Uploaded By: </strong> Polash Rana</p>
                    <p><strong>Uploaded at: </strong> 2 months ago</p>
                    <div class="book-description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>

                    <div class="book-buttons mt-4">
                        {{-- <a href="" class="btn btn-outline-success"><i class="fa fa-check"></i> Already Read</a>
                        <a href="book-view.html" class="btn btn-outline-warning"><i class="fa fa-cart-plus"></i> Add to Cart</a>
                        <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Add to Wishlist</a> --}}
                        @auth
                            @if ($book->quanity > 0)
                                @if (!is_null(App\Models\User::bookRequest($book->id)))
                                @if (App\Models\User::bookRequest($book->id)->status == 1)
                                <span class="badge badge-success" style="padding: 12px; border-radius: 0px; font-size: 14px; ">Already Requested</span>
                                @endif

                                @if (App\Models\User::bookRequest($book->id)->status == 2)
                                <span class="badge badge-success" style="padding: 12px; border-radius: 0px; font-size: 14px; ">Owner Confirm.</span>
                                @endif

                                @if (App\Models\User::bookRequest($book->id)->status == 3)
                                <span class="badge badge-danger" style="padding: 12px; border-radius: 0px; font-size: 14px; ">Owner Rejected.</span>
                                @endif

                                @if (App\Models\User::bookRequest($book->id)->status == 4)
                                <span class="badge badge-success" style="padding: 12px; border-radius: 0px; font-size: 14px; ">Reading..</span>
                                @endif

                                @if (App\Models\User::bookRequest($book->id)->status == 4)
                                <a href="#returnBookModal{{ $book->id }}" class="btn btn-success" data-toggle="modal"><i class="fas fa-arrow-right">Return Book</i></a>

                                {{-- modal --}}
                                <div class="modal fade" id="returnBookModal{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Return <mark>{{ $book->name }}</mark>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="{{ route('book.return.store',$book->slug) }}" method="post">
                                            @csrf
                                            <p>
                                                Are you sure to return the book ?
                                            </p>

                                            <button type="submit" class="btn btn-outline-success mt-2"><i class="fas fa-send-backward"></i> Send Return Rrquest</button>
                                        </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                                @if (App\Models\User::bookRequest($book->id)->status == 1)
                                    <a href="#requestUpdateModal{{ $book->id }}" class="btn btn-success" data-toggle="modal"><i class="fas fa-check-circle">Update Request</i></a>

                                    <form class="form-inline" action="{{ route('user.book.delete.request',App\Models\User::bookRequest($book->id)->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                    <button type="submit" class="btn btn-danger ">Cancel Request</button>
                                    </form>
                                    <div class="modal fade" id="requestUpdateModal{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                            Update Request for <mark>{{ $book->name }}</mark>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="{{ route('user.book.update.request',App\Models\User::bookRequest($book->id)->id) }}" method="post">
                                                @csrf
                                                <p>
                                                    Update your  request to owner of this book ?
                                                </p>
                                                <textarea name="user_message" id="user_message" class="form-control"  rows="5" placeholder="Enter Your message to the owner (keep empty if there is no message )" required>{{ App\Models\User::bookRequest($book->id)->user_message }}</textarea>
                                                <button type="submit" class="btn btn-outline-success mt-2"><i class="fas fa-send-backward"></i> Send Request Now</button>
                                            </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                                @else
                                <a href="#requestModal{{ $book->id }}" class="btn btn-success" data-toggle="modal"><i class="fas fa-check-circle">Send Request</i></a>
                                @endif
                            @else
                              <span class=" badge badge-info" style="padding: 12px; border-radius: 0px; font-size: 14px; ">
                                  Someone is reading this book..
                              </span>
                            @endif

                        @endauth

                        <!-- Modal -->
                        <div class="modal fade" id="requestModal{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Request for <mark>{{ $book->name }}</mark>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('user.book.request',$book->slug) }}" method="post">
                                    @csrf
                                    <p>
                                        Send a request to owner of this book ?
                                    </p>
                                    <textarea name="user_message" id="user_message" class="form-control"  rows="5" placeholder="Enter Your message to the owner (keep empty if there is no message )" required></textarea>
                                    <button type="submit" class="btn btn-outline-success mt-2"><i class="fas fa-send-backward"></i> Send Request Now</button>
                                </form>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
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

@endsection
