@extends('backend.layouts.master')

@section('title')
    Publishers List|Dashboard-page
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                @include('backend.layouts.partials.message')
                <div class=" text-right mb-4">
                    <a href="" data-toggle="modal" data-target="#AddModal" class="btn btn-success"><i class="fas fa-plus-circle"> Add publishers</i></a>
                    @include('backend.pages.publishers.create')
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Publishers List</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Link</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Outlet</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($publishers as $publisher)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $publisher->name }}</td>
                                        <td>{{ $publisher->link }}</td>
                                        <td>{{ $publisher->address }}</td>
                                        <td>{{ $publisher->outlet }}</td>
                                        <td>
                                            
                                             <p class="" style="display:inline; width: 100px;">
                                                       {{-- edit  --}}
                                                <a href="{{ route('publisher.edit', $publisher->id) }}" data-toggle="modal" data-target="#EditModal{{ $publisher->id}}" class="btn btn-success btn-sm mr-2"><i class="fas fa-edit"></i> Edit</a>
                                                @include('backend.pages.publishers.edit')

                                                {{-- delete  --}}
                                                <a href="{{ route('publisher.destroy',$publisher->id) }}"  class=" btn-sm btn btn-danger" data-toggle="modal" data-target="#DeleteModal{{ $publisher->id }}"><i class="far fa-trash-alt"></i> Delete</a>
                                             </p>


                                                <!-- Modal -->
                                                <div class="modal fade" id="DeleteModal{{ $publisher->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                                <form class="form-inline" action="{{ route('publisher.destroy',$publisher->id)}}" method="post">
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
    </div>
@endsection
