@extends('dashboard')
<style>
    html,
    body {
        overflow: hidden;
        height: 100%;
    }
    
    .eye-icon {
        font-size: 18px !important;
    }
</style>
@section('content')
<main class="login-form"
    style="background-image: url('/images/backgroundHome.jpg'); background-size: cover; background-position: center; height: 100vh; opacity: 0.9">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4" style="background-color: black; opacity: 0.9; margin-top: 30px;">
                <div>
                    <h3 class="card-header text-center text-white">Đăng Nhập</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-envelope"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <input type="text" placeholder="Email" id="email" class="form-control form-control"
                                        name="email" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <input type="password" placeholder="Mật Khẩu" id="password" class="form-control"
                                        name="password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa-solid fa-eye eye-icon"></i>
                                        </button>
                                    </div>

                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block"
                                    style="background-color: red; font-family: cursive;">Đăng nhập</button>
                            </div>

                            <div class="text-center mt-3" style="padding-left: 150px">
                                <p class="text-white">Chưa có tài khoản? <a href="{{ route('register-user') }}"
                                        class="text-white">Đăng ký ngay!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@if (session('success'))
    <div id="successAlert" class="alert alert-success" role="alert"
        style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function () {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000); // Hide after 3 seconds
    </script>
@endif

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
@endsection
@extends('dashboard')
<style>
    html,
    body {
        overflow: hidden;
        height: 100%;
    }
    
    .eye-icon {
        font-size: 24px !important;
    }
</style>
@section('content')
<main class="login-form"
    style="background-image: url('/images/backgroundHome.jpg'); background-size: cover; background-position: center; height: 100vh; opacity: 0.8">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4" style="background-color: black; opacity: 0.9; margin-top: 30px;">
                <div>
                    <h3 class="card-header text-center text-white">Đăng Nhập</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-envelope"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <input type="text" placeholder="Email" id="email" class="form-control form-control"
                                        name="email" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <input type="password" placeholder="Mật Khẩu" id="password" class="form-control"
                                        name="password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa-solid fa-eye eye-icon"></i>
                                        </button>
                                    </div>

                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block"
                                    style="background-color: red; font-family: cursive;">Đăng nhập</button>
                            </div>

                            <div class="text-center mt-3" style="padding-left: 150px">
                                <p class="text-white">Chưa có tài khoản? <a href="{{ route('register-user') }}"
                                        class="text-white">Đăng ký ngay!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@if (session('success'))
    <div id="successAlert" class="alert alert-success" role="alert"
        style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function () {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000);
    </script>
@endif

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
@endsection
