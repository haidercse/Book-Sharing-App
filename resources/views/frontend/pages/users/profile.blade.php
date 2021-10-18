@extends('frontend.layouts.master')
@section('frontend-title')
    User Profile
@endsection
@section('main-content')
<div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-12 p-1">
            <div class="profile-tab border p-2">
              <h3 class="">User: {{ $user->name }}</h3>
              <p><strong>Uploaded Books: </strong></p>

              <div class="clearfix"></div>

              <hr>
              @include('frontend.pages.books.partials.recent-upload')

            </div>
          </div>

      </div>
    </div>
</div>
@endsection
