@extends('dashboard')

<style>
    html,
    body {
        height: 100%;
    }
</style>

@section('content')
<main class="main-container bg">
    <div class="row">
        <!-- Avatar Container -->
        <div class="col-md-3">
            <div class="avatar-container"
                style="position: relative; width: 300px; height: 200px; flex-direction: column; overflow: hidden; background-color: #202020; margin: 30px 30px; display: flex; justify-content: center; align-items: center; border-radius: 10%;">
                <img src="{{ asset(Auth::user()->images) }}" alt="User Avatar"
                    style="width: 100px; height: 100px; border-radius: 50%;">
                <div style="color: white; margin-top: 10px;">
                    <h4 style="margin: 0;">{{ Auth::user()->name }}</h4>
                </div>
            </div>
        </div>

        <!-- Information Box -->
        <div class="col-md-9">
            <div class="avatar-container"
                style="position: relative; width: 700px; height: 530px; flex-direction: column; overflow: hidden; background-color: #202020; margin: 30px 100px; display: flex; padding-left: 50px">
                <div style="margin-top: 30px;">
                    <h4 style="margin-bottom: 70px; margin-left: 30px; margin-top: 30px; color: white;">Hồ sơ cá nhân
                    </h4>
                    <p
                        style="font-size: 20px; margin-bottom: 40px; margin-left: 50px; font-family: cursive; color: white;">
                        <strong>Tên: </strong> {{ Auth::user()->name }}
                    </p>
                    <p
                        style="font-size: 20px; margin-bottom: 40px; margin-left: 50px; font-family: cursive; color: white;">
                        <strong>Email: </strong> {{ Auth::user()->email }}
                    </p>
                    <p
                        style="font-size: 20px; margin-bottom: 40px; margin-left: 50px; font-family: cursive; color: white;">
                        <strong>Số điện thoại:</strong> {{ Auth::user()->phone }}
                    </p>
                    <p style="font-size: 20px; margin-bottom: 40px; margin-left: 50px;  color: white;">
                        <strong>Ngày sinh:</strong> {{ \Carbon\Carbon::parse(Auth::user()->date)->format('d/m/Y') }}
                    </p>

                    <div style="display: flex;
                            justify-content: center; margin-bottom: 30px">
                        <a href="{{route('user.editUser', Auth::user()->id)}}" class="btn btn-dark btn-block"
                            style="background-color: red; font-family: cursive; margin-bottom: 30px;">Sửa thông tin</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <header style="display: flex;
            justify-content: space-between;
            align-items: center;">
        <h4 class="section-title text-white Top10ShowInVN">Lịch sử phim</h4>
        <form action="{{ route('user.deleteMovieWatched') }}" method="POST">
            @csrf
            <button type="submit" class="btn" style="
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-family: cursive;
            margin-right: 40px;">Xóa lịch sử phim</button>
        </form>
    </header>

    <section class="row" style="overflow-y: auto;">
        <div class="col-12">
            @if($watchedMovies->isEmpty())
                <p class="text-center text-white" style="font-family: cursive; font-size: 20px; font-weight: 700px;">Chưa có phim đã xem</p>
            @else
                <div class="d-flex flex-row">
                    @foreach($watchedMovies as $movie)
                        <div class="col-sm-6 col-md-4 col-lg-3 px-1">
                            <a href="{{ route('user.showMovie', ['id' => $movie->id, 'tuoi' => \Carbon\Carbon::parse(Auth::user()->date)->age]) }}"
                                style="text-decoration: none;">
                                <div class="card bg text-white">
                                    @if($movie->age_limit)
                                        <span class="badge bg-danger" style="position: absolute; top: 10px; right: 50px;">18+</span>
                                    @endif
                                    <img src="{{ asset($movie->images) }}" alt="{{ $movie->movie_name }}"
                                        class="card-img-top mx-auto d-block"
                                        style="width: 200px; height: 150px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $movie->movie_name }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
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
@endsection