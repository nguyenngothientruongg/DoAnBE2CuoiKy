@extends('dashboard')
<style>
    html,
    body {
        overflow: hidden;
        height: 100%;
    }
</style>
@section('content')
<main class="main-container" style="background-color: #111111; width: 100%; height: 100vh;">
    <div style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
        <video autoplay loop muted 
            style="opacity: 0.4; position: absolute; right: 0; width: auto; height: auto; margin-right: 50px; z-index: 1;">
            <source src="{{ asset('video/doraemon.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="text-white" style="padding: 50px 800px 50px 50px; z-index: 0; margin-top: 0;">
            <h1>Tại sao bạn nên chọn ChillWithM?</h1>
            <p>Tại sao bạn lại chọn bỏ ra hơn 100.000đ ra để xem phim trong khi bạn có thể xem miễn phí với ChillWithM. Đến với
                chúng tôi ngay.
                ChillWithM chọn bạn còn Netflix thì không?
            </p>
            <p>Bỏ ra 200.000đ để đăng ký tài khoản ngay!!!</p>
            <a href="{{ route('register-user') }}" class="btn text-white" style="width: 121px; background-color: #FF0000; border-radius: 50px; font-size: 20px;">Đăng ký</a>
        </div>
    </div>
</main>
@if (session('success'))
    <div id="successAlert" class="alert alert-success" role="alert" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000); 
    </script>
@endif
@endsection
