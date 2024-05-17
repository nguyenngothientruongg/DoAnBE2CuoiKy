@extends('dashboard')
<style>
    html,
    body {
        overflow-x: hidden;
        height: 100%;
    }
</style>
@section('content')
<main class="signup-form"
    style="background-image: url('/images/backgroundHome.jpg'); background-size: cover; background-position: center; height: 100vh; opacity: 0.8">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4" style="background-color: black; opacity: 0.9; margin-top: 30px;">
                <div>
                    <h3 class="card-header text-center text-white">Đăng Ký</h3>
                    <div class="card-body">
                        <form action="{{ route('register.custom') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Tên tài khoản" id="name" class="form-control"
                                    name="name" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address" class="form-control"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Mật khẩu" id="password" class="form-control"
                                    name="password" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Nhập lại mật khẩu" id="password_confirmation"
                                    class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="form-group mb-3">
                                <input type="tel" placeholder="Số điện thoại" id="phone" class="form-control"
                                    name="phone" required>
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="date" id="date" class="form-control" name="date" required>
                                @if ($errors->has('date'))
                                    <span class="text-danger">{{ $errors->first('date') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                            <label for="video" class="text-white">Avatar</label>
                            <input type="file" id="Ảnh" class="form-control" name="images"
                                    enctype="multipart/form-data" required>
                                @if ($errors->has('images'))
                                    <span class="text-danger">{{ $errors->first('images') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-block text-white"
                                    style="background-color: red; font-family: cursive;">Đăng ký</button>
                            </div>
                        </form>
                        <div class="text-center mt-3" style="padding-left: 150px">
                            <p class="text-white">Đã có tài khoản? <a href="{{ route('login') }}" class="text-white">Đăng nhập ngay!</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection