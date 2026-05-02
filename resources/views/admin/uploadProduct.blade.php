@extends('admin.adminlayouts.adminLayout')
@section('admincontent')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UploadProduct</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 mt-3">
                <div class="text-center mt-4"><h2>Upload Product</h2></div>

                @if(session()->has('uploaded'))
                    <div class="alert alert-success">
                        <p>{{ session()->get('uploaded') }}</p>
                    </div>
                @endif

                <form action="{{ URL::to('uploadnewproduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="my-3">
                        <input type="text" placeholder="Name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        <input type="number" placeholder="Price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        <input type="text" placeholder="Discription" name="discription" class="form-control @error('discription') is-invalid @enderror" value="{{ old('discription') }}" required>
                        @error('discription')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="text-center mt-5"><h2>Optional Products</h2></div>

                    <div class="my-3">
                        <input type="file" name="file1" class="form-control">
                    </div>
                    <div class="my-3">
                        <input type="file" name="file2" class="form-control">
                    </div>
                    <div class="my-3">
                        <input type="file" name="file3" class="form-control">
                    </div>
                    <div class="my-3">
                        <input type="file" name="file4" class="form-control">
                    </div>

                    <div class="my-4">
                        <label class="form-label"><h2>Category</h2></label>
                        <div class="row">
                            <div class="col-12 col-sm-6 d-flex align-items-center mb-2">
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="category"
                                        id="custom"
                                        value="Custom"
                                        {{ old('category') == 'Custom' ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label ms-2" for="custom">Custom</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 d-flex align-items-center mb-2">
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="category"
                                        id="readymade"
                                        value="ReadyMade"
                                        {{ old('category') == 'Ready_Made' ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label ms-2" for="readymade">Ready Made</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-4 text-center">
                        <button type="submit" class="btn btn-success px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('css/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
@endsection
