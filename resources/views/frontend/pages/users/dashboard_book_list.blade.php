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
              <h3 class="float-left">My Uploaded Books</h3>
              <div class="clearfix"></div>
              <hr>

              <div>
                @include('frontend.pages.books.partials.recent-upload')
              </div>


            </div>
          </div>
          <div class="col-md-4 p-1">
            @include('frontend.pages.users.partials.sidebar')
          </div>
      </div>
    </div>
</div>
@endsection
