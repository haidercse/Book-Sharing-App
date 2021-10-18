@extends('frontend.layouts.master')
@section('frontend-title')
    User Books List
@endsection
@section('main-content')
<div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8 p-1">
            <div class="profile-tab border p-2">
              <h3 class="float-left">My Requested Books</h3>
              <div class="clearfix"></div>
              <hr>
              <table class="table table-striped table-bordered table-responsive" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book</th>
                    <th scope="col">Requester</th>
                    <th scope="col">Message</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($book_requests as $item)
                  <tr>
                    <th scope="row">{{ $loop->index + 1}}</th>
                    <td>
                        <a href="{{ route('user.book.show.request.page',$item->book->slug) }}">{{ $item->book->title }}</a>
                    </td>
                    <td>
                        {{ $item->user->name }}
                        <a href="call:{{ $item->user->phone_no }}" class="btn btn-info"><i class="fas fa-phone" title="Call to the User"></i></a>

                    </td>
                    <td>{{ $item->user_message }}</td>
                    <td>
                        @if ($item->status == 1)
                           Request Sent.
                        @elseif($item->status == 2)
                          Request Approved.
                        @elseif($item->status == 3)
                          Request Rejected
                        @elseif($item->status == 4)
                           User Confirm
                        @elseif($item->status == 5)
                           User Rejected
                        @elseif($item->status == 6)
                          Return Rquest
                        @elseif($item->status == 7)
                          Return Confirm
                        @endif
                        @if ($item->status == 1)
                            <form action="{{ route('user.book.request.approved',$item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="bt btn-sm btn-success">Approved</button>
                            </form>
                            <form class="mt-1" action="{{ route('user.book.request.reject',$item->id) }}" method="post" >
                                @csrf
                                <button type="submit" class="bt btn-sm btn-danger">Reject</button>
                            </form>
                        @elseif($item->status == 2)
                            <form class="mt-1" action="{{ route('user.book.request.reject',$item->id) }}" method="post" >
                                @csrf
                                <button type="submit" class="bt btn-sm btn-danger">Reject</button>
                            </form>
                        @elseif($item->status == 3)
                            <form action="{{ route('user.book.request.approved',$item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="bt btn-sm btn-success">Approved</button>
                            </form>
                            @elseif($item->status == 6)
                            <form action="{{ route('book.return.confirm',$item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="bt btn-sm btn-success">Confirm Return</button>
                            </form>
                        @endif

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-4 p-1">
            @include('frontend.pages.users.partials.sidebar')
          </div>
      </div>
    </div>
</div>
@endsection
