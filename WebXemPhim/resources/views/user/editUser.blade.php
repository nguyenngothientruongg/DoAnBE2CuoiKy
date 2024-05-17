@extends('dashboard')
<style>
    html,
    body {
        overflow: hidden;
        height: 100%;
    }
</style>
@section('content')
<main class="signup-form bg" style="background-size: cover; background-position: center; height: 100vh;">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4" style="background-color: black; opacity: 0.9; margin-top: 30px;">
                <div>
                    <h3 class="card-header text-center text-white">Sửa thông tin cá nhân</h3>
                    <div class="card-body">
                        <form action="{{ route('user.updateUser', Auth::user()->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Tên" id="name" class="form-control"
                                    name="name" value="{{ Auth::user()->name }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control"
                                    name="email" value="{{ Auth::user()->email }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="number" placeholder="Số điện thoại" id="phone" class="form-control"
                                    name="phone" value="{{ Auth::user()->phone }}" required autofocus>
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="video" class="text-white">Ảnh</label>
                                <input type="file" id="Ảnh" class="form-control" name="images"
                                    enctype="multipart/form-data" required>
                                @if ($errors->has('images'))
                                    <span class="text-danger">{{ $errors->first('images') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-block text-white"
                                    style="background-color: red; font-family: cursive;">Sửa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection