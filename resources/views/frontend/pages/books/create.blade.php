@extends('frontend.layouts.master')

@section('frontend-title')
    Books Upload Page
@endsection


@section('custom-styles')

{{-- select2 css  --}}
<link rel="stylesheet"  href="{{ asset('admin/assets/css/select2.min.css') }}">

{{-- summer note css  --}}
<link rel="stylesheet"  href="{{ asset('admin/assets/css/summernote.min.css') }}">



@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-5">
                @include('backend.layouts.partials.message')
                <div class="card">
                    <div class="card-header">
                        <h3>Upload Your Book</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="exampleInputEmail1">Book Title</label>
                                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Link</label>
                                    <input type="text" name="slug" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Category</label>
                                    <select name="category_id" class="form-control select2">
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Publisher</label>
                                    <select name="publisher_id" class="form-control select2">
                                        <option value="">Select a Publisher</option>
                                        @foreach ($publishers as $publisher)
                                           <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Authors</label>
                                    <select name="author_ids[]" class="form-control select2" multiple>
                                        <option value="">Select a Author</option>
                                        @foreach ($authors as $author)
                                           <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Translator</label>
                                    <select name="translator_id" class="form-control select2">
                                        <option value="">Select a Translator Book</option>
                                        @foreach ($books as $book)
                                           <option value="{{ $book->id }}">{{ $book->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book ISBN</label>
                                    <input type="text" name="isbn" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Publish Year</label>
                                    <select name="publish_year" class="form-control select2">
                                        <option value="">Select Year</option>
                                        @for ($i = date('Y'); $i >= 1950; $i--)
                                         <option value="{{ $i }}"> {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="1" required min="1">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1">Book Details</label>
                                    <textarea name="description" class="form-control" id="summernote" cols="30" rows="10"></textarea>
                                </div>

                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('custom-scripts')

        {{-- select2 js  --}}
        <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>

        {{-- summer note js  --}}
        <script src="{{ asset('admin/assets/js/summernote.min.js') }}"></script>

        {{-- data table  --}}
        <script>
            $(document).ready(function() {

            $('.select2').select2();
            $('#summernote').summernote();

        } );
        </script>
    @endsection
@endsection
