@extends('home')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb " class="my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('#categoryList') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Categories</li>
            </ol>
        </nav>

        <div class="row">
            <h4 class="mt-2 col-5 offset-2">Add Categories</h4>

            <form method="POST" action="{{ route('#updateCategory') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 col-5 offset-2">
                    <input type="hidden" name="category_id" value="{{ $categoryData->id }}">
                    <label for="category" class="form-label">Category<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="category_name" id="category"
                        value="{{ $categoryData->category_name }}" placeholder="Input Name">
                    @error('category_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-5 offset-2">
                    <label for="formFile" class="form-label">Category Photo<span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="formFile" name="category_photo">
                    <img src="{{ asset('storage/img/' . $categoryData->category_photo) }}" width="50px" height="60px" />

                    @error('category_photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3  col-5 offset-2">
                    <div>Status</div>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="category_status" value="1"
                        {{ $categoryData->status == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="exampleCheck1">Publish</label>
                </div>
                <a class="btn btn-light text-primary col-1 offset-2 " href="javascript:history.back()">Cancel</a>

                <button type="submit" class="btn btn-primary col-1">Submit</button>
            </form>
        </div>
    </div>
@endsection
