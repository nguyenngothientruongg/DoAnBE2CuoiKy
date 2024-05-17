@extends('dashboard')
<style>
    html,
    body {
        height: 100%;
    }

    ,
</style>
@section('content')
<style>
    @keyframes slideInLeft {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(0);
        }
    }

    .slide-in-left {
        animation: slideInLeft 0.5s ease;
    }
</style>
<main class="main-container bg">
    <div id="imageContainer"
        style="display: flex; flex-direction: column; align-items: center; width: 100%; height: 100vh;">
        <header>
            <h4 id="movieName" class="section-title text-white Top10ShowInVN" style="font-family: Cursive;">
                {{ $movies[0]->movie_name }}
            </h4>
        </header>

        <div style="display: flex; align-items: center;">
            <div id="imageWrapper" style="opacity: 0; transition: opacity 0.5s ease;">
                <img id="movieImage" src="{{ $movies[0]->images }}" alt="Cannot load image"
                    style="width: 100%; height: 60vh; object-fit: cover;">
            </div>
        </div>

        <ul id="movieList" class="text-white"
            style="list-style: none; margin: 20px 0; display: flex; flex-wrap: wrap; justify-content: center;">
        </ul>
    </div>



    <header>
        <h4 class="section-title text-white Top10ShowInVN" style="font-family: Cursive;">Top 5 bộ phim trong tuần</h4>
    </header>
    <section class="row" style="overflow-y: auto;">
        <div class="col-12">
            <div class="d-flex flex-row">
                @foreach($movies->take(5) as $movie)
                    <div class="col-sm-6 col-md-4 col-lg-3 px-1">
                        <a href="{{ route('user.showMovie', ['id' => $movie->id, 'tuoi' => \Carbon\Carbon::parse(Auth::user()->date)->age]) }}" style="text-decoration: none;">
                            <div class="card bg text-white">
                                <img src="{{ $movie->images }}" alt="{{ $movie->movie_name }}"
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
        </div>
    </section>

    <header>
        <h4 class="section-title text-white Top10ShowInVN" style="font-family: Cursive;">Trở lại với thanh xuân</h4>
    </header>
    <section class="row" style="overflow-y: scroll;">
        <div class="col-12">
            <div class="d-flex flex-row">
                @foreach($movies as $movie)
                    <div class="col-sm-6 col-md-4 col-lg-3 px-1">
                        <div class="card bg text-white">
                            <img src="{{ $movie->images }}" alt="{{ $movie->movie_name }}"
                                class="card-img-top mx-auto d-block"
                                style="width: 200px; height: 150px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $movie->movie_name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <header>
        <h4 class="section-title text-white Top10ShowInVN" style="font-family: Cursive;">Mối tình năm ấy</h4>
    </header>
    <section class="row" style="overflow-y: scroll;">
        <div class="col-12">
            <div class="d-flex flex-row">
                @foreach($movies as $movie)
                    <div class="col-sm-6 col-md-4 col-lg-3 px-1">
                        <div class="card bg text-white">
                            <img src="{{ $movie->images }}" alt="{{ $movie->movie_name }}"
                                class="card-img-top mx-auto d-block"
                                style="width: 200px; height: 150px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $movie->movie_name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var posterMovies = {!! json_encode($movies->take(8)->pluck('images')->all()) !!};
        var nameMovies = {!! json_encode($movies->take(8)->pluck('movie_name')->all()) !!};
        var imageIndex = 0;
        var image = document.getElementById('movieImage');
        var name = document.getElementById('movieName');
        var container = document.getElementById('movieList');
        var originalImageIndex;
        document.getElementById('imageWrapper').style.opacity = '1';

        movieList.addEventListener('click', function (event) {
            var target = event.target;

            if (target.tagName === 'IMG') {
                var newImageSrc = target.getAttribute('src');
                var movieImage = document.getElementById('movieImage');
                imageIndex = Array.from(target.parentNode.parentNode.children).indexOf(target.parentNode);
                movieImage.setAttribute('src', newImageSrc);
            }
        });

        function changeImageAndList(num) {
            fadeOutMovieList(num);
        }

        function fadeOutMovieList(num) {
            var movieListImages = document.querySelectorAll('#movieList img');
            for (let index = 0; index < movieListImages.length; index++) {
                if (index === num) {
                    movieListImages[index].style.opacity = 1;
                } else {
                    movieListImages[index].style.opacity = 0.3;
                }
            }
        }


        for (var i = 0; i < posterMovies.length; i++) {
            var listItem = document.createElement('li');
            var img = document.createElement('img');

            img.src = posterMovies[i];
            img.alt = 'Movie Image';
            img.style.width = '100px';
            img.style.height = 'auto';
            img.style.marginRight = '30px';

            listItem.appendChild(img);
            container.appendChild(listItem);
        }

        image.addEventListener('click', function () {
            var movieId = {!! json_encode($movies->pluck('id')->all()) !!}[originalImageIndex];
            var userAge = {{ \Carbon\Carbon::parse(Auth::user()->date)->age }};
            window.location.href = "{{ route('user.showMovie', ['id' => 'movie_id', 'tuoi' => 'user_age']) }}".replace('movie_id', movieId).replace('user_age', userAge);
        });

        setInterval(function () {
            originalImageIndex = imageIndex;
            image.src = posterMovies[imageIndex];
            name.innerText = nameMovies[imageIndex];
            image.style.display = 'block';
            changeImageAndList(imageIndex);
            imageIndex = (imageIndex + 1) % posterMovies.length;
        }, 2000);

        function changeImageAndList(num) {
            fadeOutMovieList(num);
            image.classList.add('slide-in-left');
            setTimeout(function () {
                image.classList.remove('slide-in-left');
            }, 500);
        }

    });
</script>

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

@endsection