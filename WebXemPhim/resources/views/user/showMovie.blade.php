@extends('dashboard')
<style>
    html,
    body {
        height: 100%;
    }
</style>
@section('content')
<style>
    html,
    body {
        height: 100%;
        background-color: #111111;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .bground {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #fullscreenVideo {
        width: 60%;
        height: 70%;
    }

    .comment-box {
        max-width: 100%;
        margin: 20px 20px;
        padding: 10px;
        background-color: #202020;
        border: 1px solid #333;
        border-radius: 5px;
    }

    .comment-header {
        display: flex;
        align-items: center;
    }

    .comment-input {
        max-width: 800px;
        flex-grow: 1;
        margin-left: 10px;
        padding: 8px;
        background-color: #333;
        border: none;
        border-radius: 4px;
        color: white;
    }

    .comment-input::placeholder {
        color: #bbb;
    }
</style>

<header>
    <h4 class="section-title text-white" style="margin-left: 100px; margin-top: 20px; margin-bottom: 20px">
        {{ $movie->movie_name }}
    </h4>
</header>

<div class="bground">
    <video id="fullscreenVideo" controls>
        <source src="{{ asset($movie->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<header>
    <h4 class="section-title text-white Top10ShowInVN">Gợi ý phim tiếp theo</h4>
</header>

<section class="row" style="overflow-y: auto;">
    <div class="col-12">
        <div class="d-flex flex-row">
            @foreach($movies as $moviee)
                <div class="col-sm-6 col-md-4 col-lg-3 px-1">
                <a href="{{ route('user.showMovie', ['id' => $moviee->id, 'tuoi' => \Carbon\Carbon::parse(Auth::user()->date)->age]) }}" style="text-decoration: none;">
                        <div class="card bg text-white">
                            <img src="{{ asset($moviee->images) }}" alt="{{ $moviee->movie_name }}"
                                class="card-img-top mx-auto d-block"
                                style="width: 200px; height: 150px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $moviee->movie_name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<h4 class="text-white" style="text-align: left; margin-left: 20px;">Bình luận</h4>

<div class="comment-box" style="text-align: left;">
    <form action="{{route("user.customRegistrationPost")}}" method="POST">
        @csrf
        <div class="comment-header">
            <img src="{{ asset(Auth::user()->images) }}" alt="User Avatar"
                style="width: 43px; height: 43px; margin-right: 10px; border-radius: 50%;">
            <input type="text" name="comments" placeholder="Thêm bình luận..." class="comment-input">
            <input type="hidden" name="id_movie" value="{{ $movie->id }}">

            <button type="submit"
                style="width: 70px; height: 40px; margin-left: 10px; background-color: #FF0000; color: white; border: none; cursor: pointer; border-radius: 4px;">Gửi</button>
        </div>
    </form>
    @if($posts->isNotEmpty())
        <div class="comment-list">
            @foreach($posts as $post)
                <div class="comment-item text-white d-flex align-items-center">
                    <img src="{{ asset($post->user->images) }}" alt="User Avatar"
                        style="width: 43px; height: 43px; margin-right: 10px; border-radius: 50%;">
                    <div>
                        <p style="margin-bottom: 0; margin-right: 10px; margin-top: 12px; font-size: 17">{{ $post->user->name }}
                        </p>
                        <p style="color: #777777;">{{ $post->comments }}</p>
                    </div>
                    @if(Auth::check() && $post->id_user == Auth::user()->id)
                        <div class="ms-auto">
                            <form action="{{route("user.deletePost", $post->id)}}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background-color: #202020;"
                                    onclick="return confirm('Bạn có muốn xoá bình luận này?')">
                                    <i class="fa-solid fa-trash" style="font-size: 20px; color: #AAAAAA;"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-white">Chưa có bình luận, hãy bình luận cho tụi mình nhé</p>
    @endif
</div>

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