@extends('layouts.app')

@section('content')

<div class="container-fluid w-75 mt-5">
    <div class="card-body p-3 rounded-4" style="background: #242526">
        <div class="d-flex">
            <img height="50" width="50" class="rounded-circle me-2" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-1/316541946_876752107083217_5841789909563890176_n.jpg?stp=dst-jpg_p160x160&_nc_cat=107&ccb=1-7&_nc_sid=5740b7&_nc_eui2=AeHp6OL09d2UfnUuFcRlp8baIdqJpC8rMSgh2omkLysxKCdoRpbmZRyInp5_zCnXNT8QmYMTBdoAECcciFLtEg89&_nc_ohc=d_yjGSRNqBUAX_T5s1L&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAfJFIL8QroDj56-ZDWKXy_aqCjakM1j-khVAWNQOkaTw&oe=65708B1D" alt="">
            <button type="button" class="form-control btn rounded-5 text-start text-white" style="background: #3A3B3C"  data-coreui-toggle="modal" data-coreui-target="#exampleModal">
                <strong style="margin-left: 20px">Add your MASTERPIECE</strong>
            </button> <br>

        </div>
        <hr style="color: rgb(174, 174, 174)">
        <div class="row text-center">
            <div class="col">
                <a href="{{ route('my-post.index') }}" class="btn" style="color: #7b7d7f"><strong>My Post</strong></a>
            </div>
            <div class="col">
                <a href="" class="btn" style="color: #7b7d7f"><strong>My Messages</strong></a>
            </div>
        </div>
    </div>
        @foreach ($arts as $art)
        <div class="card-body my-4 py-4 rounded-4 text-center" style="background: #242526">
            <img style="max-height: 856px; max-width: 800px" class="rounded-4" src="{{ asset('storage/' . $art->image) }}" alt="">
            <br> <br>
            <form action="{{ route('like.store') }}" method="POST">
            @csrf
            <div class="text-start" style="border-bottom: 1px solid rgb(174, 174, 174); border-top: 1px solid rgb(174, 174, 174)">
                <input type="hidden" name="art_id" value="{{ $art->id }}">
            <button style="width: 100%; background: #242526; color: #7b7d7f; padding-left: 40px" class="btn border-0 text-start py-2 my-2" type="submit">
                    <i class="fas fa-thumbs-up"></i> <strong>{{ $art->likes?->count() }}</strong> Like(s)
                </button>
            </div>
        </form>
        </div>
        @endforeach
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" >
              <div class="modal-content text-white" style="background: #242526">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add your ART</h5>
                  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="@admin {{ route('art.admin') }} @endadmin @client {{ route('art.store') }} @endclient" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-3">
                          <label for="">Art Category</label>
                          <select name="category_id" id="" class="form-select">
                            <option value="" selected disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group mt-3">
                          <label for="">Art Title</label>
                          <input type="text" placeholder="Title" name="title" class="form-control">
                        </div>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group mt-3">
                          <label for="">Your ART</label>
                          <input type="file" name="image" class="form-control">
                        </div>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                </form>
              </div>
            </div>
          </div>
</div>
@endsection
