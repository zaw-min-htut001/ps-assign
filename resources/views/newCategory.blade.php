@extends('home')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb " class="my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('#categoryList') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Categories</li>
            </ol>
        </nav>

        <div class="row">
            <h4 class="mt-2 col-5 offset-2">Add Categories</h4>

            <form method="POST" action="{{ route('#addCategory') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 col-5 offset-2">
                    <label for="category" class="form-label">Category<span class="text-danger">*</span></label>
                    <input @error('category_name') is-invalid @enderror type="text" class="form-control"
                        name="category_name" id="category" placeholder="Input Name">
                    @error('category_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-5 offset-2">
                    <label for="formFile" class="form-label">Category Photo<span class="text-danger">*</span></label>
                    <input @error('category_photo') is-invalid @enderror class="form-control" type="file" id="formFile"
                        name="category_photo">
                    @error('category_photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3  col-5 offset-2">
                    <div>Status</div>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="category_status"
                        value="1">
                    <label class="form-check-label" for="exampleCheck1">Publish</label>
                </div>
                <button type="submit" class="btn btn-light text-primary col-1 offset-2">Cancel</button>
                <button type="submit" class="btn btn-primary col-1">Submit</button>
            </form>
        </div>
    </div>
@endsection
