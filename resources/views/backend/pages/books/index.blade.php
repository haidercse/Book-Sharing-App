@extends('backend.layouts.master')

@section('title')
    Books List|Dashboard-page
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                @include('backend.layouts.partials.message')
                <div class=" text-right mb-4">
                    <a href="{{ route('book-sharing.create') }}"  class="btn btn-success"><i class="fas fa-plus-circle"> Add Books</i></a>

                </div>
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Books List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="data-table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Link</th>
                                <th scope="col">Book Category</th>
                                <th scope="col">Publisher Name</th>
                                <th scope="col">Statistics</th>
                                <th scope="col">Image</th>
                                <th scope="col">Is_approved</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->slug }}</td>
                                    <td>
                                        @if (empty($book->category->name))
                                           NULL
                                        @else
                                         {{ $book->category->name }}
                                        @endif

                                    </td>
                                    <td>
                                        @if (empty($book->publisher->name))
                                            NULL
                                        @else
                                           {{ $book->publisher->name }}
                                        @endif
                                    </td>
                                    <td>
                                        <i class="fas fa-eye"></i> {{ $book->total_view }}
                                        <br>
                                        <i class="fas fa-search"></i> {{ $book->total_search }}
                                    </td>

                                    <td>
                                        <img src="{{ asset('images/book/'.$book->image) }}" width="82" alt="{{ $book->title }}">
                                    </td>

                                    <td>

                                        @if (isset($approved))
                                          @if (!$approved)
                                            <form action="{{ route('admin.approve.book',$book->id) }}" method="POST">
                                                @csrf
                                               <button type="submit" class=" mt-2 btn btn-sm btn-success"><i class="fas fa-check"></i> Approved Now</button>
                                            </form>
                                          @else
                                            <form action="{{ route('admin.unApprove.book',$book->id) }}" method="POST">
                                                @csrf
                                            <button type="submit" class=" mt-2 btn btn-sm btn-danger"><i class="fas fa-check"></i> UnApproved Now</button>
                                            </form>
                                          @endif
                                        @else
                                            @if ($book->is_approved)
                                              <span class="badge badge-success"><i class="fas fa-check-circle"></i> Approved</span>
                                            @else
                                              <span class="badge badge-danger"><i class="fas fa-times"></i> Not Approved</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <p class="" style="display: inline">
                                                {{-- edit  --}}
                                            <a href="{{ route('book-sharing.edit', $book->id) }}" class="btn btn-success btn-sm mr-1"><i class="fas fa-edit"></i></a>

                                            {{-- delete  --}}
                                            <a href="{{ route('book-sharing.destroy',$book->id) }}"  class=" btn-sm btn btn-danger" data-toggle="modal" data-target="#DeleteModal{{ $book->id }}"><i class="far fa-trash-alt"></i></a>


                                             <!-- Modal -->
                                            <div class="modal fade" id="DeleteModal{{ $book->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Are You sure to delete this?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-left">
                                                            <form class="form-inline" action="{{ route('book-sharing.destroy',$book->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class=" btn btn-danger" type="submit">Permamnet Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
