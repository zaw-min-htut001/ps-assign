@extends('home')

@section('content')
    <div class="container-fluid">
        <h4 class="mt-2">Categories</h4>
        <div class="d-flex justify-content-end my-4">
            <a class="btn btn-primary" href="{{ route('#newCategory') }}">+ Add Category</a>
        </div>

        @if (session('Add'))
            <div class="alert alert-success alert-dismissible fade show offset-8 col-4" role="alert">
                <strong> {{ session('Add') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('Update'))
            <div class="alert alert-success alert-dismissible fade show offset-8 col-4" role="alert">
                <strong> {{ session('Update') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show offset-8 col-4" role="alert">
                <strong> {{ session('delete') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">No</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Publish</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoryData as $item)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('#categoryEdit', $item->id) }}">
                                <i class="fa-solid fa-pen bg-success text-light  p-2 me-3"></i>
                            </a>
                            <a href="{{ route('#deleteCategory', $item->id) }}">
                                <i class="fa-solid fa-trash bg-danger text-light p-2 "></i>
                            </a>
                        </th>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{ $item->id }}"
                                    {{ $item->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheck{{ $item->id }}"></label>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
