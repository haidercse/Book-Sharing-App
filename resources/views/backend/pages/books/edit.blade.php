@extends('backend.layouts.master')

@section('title')
    Book Edit Page
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.partials.message')
                <div class="card">
                    <div class="card-header">
                        <h3>Book Add</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('book-sharing.update',$book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="exampleInputEmail1">Book Title</label>
                                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $book->title }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Link</label>
                                    <input type="text" name="slug" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $book->slug }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Category</label>
                                    <select name="category_id" class="form-control select2">
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                           <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Publisher</label>
                                    <select name="publisher_id" class="form-control select2">
                                        <option value="">Select a Publisher</option>
                                        @foreach ($publishers as $publisher)
                                           <option value="{{ $publisher->id }}" {{ $book->publisher_id == $publisher->id ? 'selected' : ''}}>{{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Authors</label>
                                    <select name="author_ids[]" class="form-control select2" multiple>
                                        <option value="">Select a Author</option>
                                        @foreach ($authors as $author)
                                           <option value="{{ $author->id }}" {{App\Models\Book::isAuthorSelected($book->id, $author->id)? 'selected' : ''}}>{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Translator</label>
                                    <select name="translator_id" class="form-control select2">
                                        <option value="">Select a Translator Book</option>
                                        @foreach ($books as $tb)
                                           <option value="{{ $tb->id }}" {{ $tb->id == $book->translator_id ? 'selected' : ''}}>{{ $tb->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmailQuantity">Book Quantity</label>
                                    <input type="number" name="quantity" class="form-control" id="exampleInputEmailQuantity" aria-describedby="emailHelp" value="{{ $book->quantity }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book ISBN</label>
                                    <input type="text" name="isbn" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $book->isbn }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Book Publish Year</label>
                                    <select name="publish_year" class="form-control select2">
                                        <option value="">Select Year</option>
                                        @for ($i = date('Y'); $i >= 1950; $i--)
                                         <option value="{{ $i }}" {{ $book->publish_year == $i ? 'selected' : ''}}> {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    @if (!is_null($book->image))
                                    <label for="exampleInputEmail1">Old Book Image</label><br>
                                    <img src="{{ asset('images/book/'.$book->image) }}" width="82"><br>
                                    @endif

                                    <label for="exampleInputEmail1">Book Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1">Book Details</label>
                                    <textarea name="description" class="form-control" id="summernote" cols="30" rows="10">{!! $book->description !!}</textarea>
                                </div>

                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
