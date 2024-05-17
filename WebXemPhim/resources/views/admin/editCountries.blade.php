@extends('dashboard')
<style>
    html,
    body {
        overflow-x: hidden;
        height: 100%;
    }
</style>
@section('content')
<main class="signup-form bg" style="background-size: cover; background-position: center; height: 100vh;">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4" style="background-color: black; opacity: 0.9; margin-top: 30px;">
                <div>
                    <h3 class="card-header text-center text-white">Sửa thông tin quốc gia</h3>
                    <div class="card-body">
                        <form action="{{ route('admin.updateCountries', $countries->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Tên quốc gia" id="name" class="form-control"
                                    name="name" value="{{ $countries->name }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>


                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-block text-white"
                                    style="background-color: red; font-family: cursive;">Sửa quốc gia</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection