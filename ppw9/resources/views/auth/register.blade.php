@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5"> 
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body"> 
                <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}"> 
                            @if ($errors->has('name')) 
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"> 
                            @if ($errors->has('email')) 
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div> 
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                    </div>

                    <!-- <form action="{{ route('update-photo') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="photo" class="form-label">Ubah Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    @if(Auth::check() && Auth::user()->photo)
                    <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="User Photo">
                    @endif
                </form> -->

                <form action="{{ route('update-photo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="photo" class="form-label">Ubah Photo</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <!-- Tambahkan elemen img untuk menampilkan gambar -->
                <img id="previewImage" src="" alt="Preview Image" style="max-width: 300px; margin-top: 10px;">
                
                
                <script>
                document.getElementById('photo').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const reader = new FileReader();
                    reader.onload = function() {
                        const previewImage = document.getElementById('previewImage');
                        previewImage.src = reader.result;
                    }
                    reader.readAsDataURL(file);
                    });
                    </script>


            </div>
        </div>
    </div>
</div>
<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f5f5f5;
    }

    .navbar {
        background-color: #6b6bff;
    }

    .navbar-brand {
        font-weight: bold;
        color: #ffffff;
    }

    .nav-link {
        color: #ffffff !important;
    }

    .nav-link.active {
        font-weight: bold;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin: 20px;
    }

    .card-header {
        text-align: center;
        background-color: #6b6bff;
        border-bottom: none;
        font-size: 1.5rem;
        font-weight: bold;
        color: #ffffff;
        border-radius: 10px 10px 0 0;
        padding: 15px;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .btn-primary {
        background-color: #6b6bff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #4d4dff;
    }

    .btn-primary:focus {
        box-shadow: 0 0 0 0.2rem rgba(107, 107, 255, 0.5);
    }

    .btn-link {
        color: #6b6bff;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    .table {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px;
    }

    .table th, .table td {
        border: none;
    }
</style>

@endsection

