<div class="row">

    @foreach ($books  as $book)
    <div class="col-md-4">
        <div class="single-book">
        <img src="{{ asset('images/book/'.$book->image )}}" alt="{{ $book->title}}">
            <div class="book-short-info">
                <h5>{{ $book->title }}</h5>
                <p>
                <a href="{{ route('user.show',$book->user->username) }}" class=""><i class="fa fa-upload"></i>
                    @if (!empty($book->user_id))
                        {{ $book->user->name }}
                    @else
                        Nothing
                    @endif
                </a>
                </p>

                @if (Route::is('user.upload.book.list'))
                  <a href="{{ route('user.book.show.request.page',$book->slug) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a>
                  <a href="{{ route('user.book.edit',$book->slug) }}" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>

                   {{-- delete  --}}
                   <a href="{{ route('user.book.delete',$book->id) }}"  class="  btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal{{ $book->id }}"><i class="far fa-trash-alt"></i></a>


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
                                  <form class="form-inline" action="{{ route('user.book.delete',$book->id)}}" method="post">
                                      @csrf

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
                @else
                 <a href="{{ route('user.book.show.request.page',$book->slug) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> View</a>
                 <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Wishlist</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach

</div>
