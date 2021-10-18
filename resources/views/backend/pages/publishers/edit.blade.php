<!-- Modal -->
<div class="modal fade" id="EditModal{{ $publisher->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Publishers</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-left">
                <form action="{{ route('publisher.update',$publisher->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1"> Publisher Name</label>
                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $publisher->name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> Publisher Link</label>
                            <input type="text" name="link" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $publisher->link }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> Publisher Outlet</label>
                            <input type="text" name="outlet" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $publisher->outlet }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> Publisher Address</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $publisher->address }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">publisher Details</label>
                            <textarea name="description" class="form-control" cols="30" rows="5">{{ $publisher->description }}</textarea>
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
