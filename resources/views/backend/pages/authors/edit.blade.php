
  <!-- Modal -->
  <div class="modal fade" id="EditModal{{ $author->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Authors</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-left">
                <form action="{{ route('author.update',$author->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="exampleInputEmail1"> Author Name</label>
                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $author->name }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Author Details</label>
                            <textarea name="description" class="form-control" cols="30" rows="5">{{ $author->description }}</textarea>
                        </div>

                    </div>
                    <button class="btn btn-success" type="submit">Update!</button>
                  </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
