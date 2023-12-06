@extends('home')

@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb " class="my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('#itemList') }}">Item Lists</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Items</li>
            </ol>
        </nav>

        <div class="container ">
            <h4 class="mt-2 ">Add Items</h4>
            <form method="POST" action="{{ route('#addItem') }}" enctype="multipart/form-data">
                @csrf
                <div class="row m-2 ">
                    <div class="col-6 bg-light min-vh-100">
                        <h4>Item Information</h4>
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1">Item Name<span class="text-danger">*</span></label>
                            <input name="item_name" type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Input Name">
                            @error('item_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Select Category<span class="text-danger">*</span></label>
                            <select name="category_name" id="category" class="form-control">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                            @error('item_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Price<span class="text-danger">*</span></label>
                            <input type="text" name="item_price" class="form-control" id="price"
                                placeholder="Enter Price">
                            @error('item_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Description<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="editor" name="item_description"></textarea>
                            @error('item_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="ItemCondition">Select Item Condition</label>
                            <select name="item_condition" id="ItemCondition" class="form-control">
                                <option value="" disabled selected>Select Item Condition</option>
                                <option value="new">New</option>
                                <option value="used">Used</option>
                                <option value="second">Good Second Hand</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="ItemType">Select Item Type</label>
                            <select name="item_type" id="ItemType" class="form-control">
                                <option value="" disabled selected>Select Item Type</option>
                                <option value="sell">Sell</option>
                                <option value="buy">Buy</option>
                                <option value="exchange">Exchange</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <div>Status</div>
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="item_status"
                                value="1">
                            <label class="form-check-label" for="exampleCheck1">Publish</label>
                        </div>
                        <div class="form-group mb-3">
                            <label for="formFile" class="form-label">Item Photo<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" name="item_photo">
                            @error('item_photo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 bg-light min-vh-100">
                        <h4>Owner Information</h4>
                        <div class="form-group mb-3">
                            <label for="name">Owner Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="owner_name" id="name"
                                aria-describedby="emailHelp" placeholder="Input Owner Name">
                            @error('owner_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="number">Contact Number</label>
                            <input id="phone" type="tel" name="number" class="form-control" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <div id="map" style="width: 100%;  height: 400px;"></div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-light text-primary col-1 offset-2">Cancel</button>
                <button type="submit" class="btn btn-primary col-1">Submit</button>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([51.5, -0.09]).addTo(map);
    </script>
    <script script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    </script>
@endsection
