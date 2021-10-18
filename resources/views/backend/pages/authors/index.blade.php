@extends('backend.layouts.master')

@section('title')
    Authors List|Dashboard-page
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                @include('backend.layouts.partials.message')
                <div class=" text-right mb-4">
                    <a href="" data-toggle="modal" data-target="#AddModal" class="btn btn-success"><i class="fas fa-plus-circle"> Add Authors</i></a>
                    @include('backend.pages.authors.create')
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Authors List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="data-table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Link</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $author)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $author->name }}</td>
                                    <td>{{ $author->link }}</td>
                                    <td>
                                        <p class="" style="display: inline">
                                                {{-- edit  --}}
                                            <a href="{{ route('author.edit', $author->id) }}" data-toggle="modal" data-target="#EditModal{{ $author->id}}" class="btn btn-success btn-sm mr-2"><i class="fas fa-edit"></i> Edit</a>
                                            @include('backend.pages.authors.edit')

                                            {{-- delete  --}}
                                            <a href="{{ route('author.destroy',$author->id) }}"  class=" btn-sm btn btn-danger" data-toggle="modal" data-target="#DeleteModal{{ $author->id }}"><i class="far fa-trash-alt"></i> Delete</a>


                                             <!-- Modal -->
                                            <div class="modal fade" id="DeleteModal{{ $author->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                            <form class="form-inline" action="{{ route('author.destroy',$author->id)}}" method="post">
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
