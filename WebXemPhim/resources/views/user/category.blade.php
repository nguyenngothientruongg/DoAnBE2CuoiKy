@extends('dashboard')

<style>
    html,
    body {
        height: 100%;
    }
</style>

@section('content')
<main class="main-container bg">
    @foreach($categories as $category => $movies)
        @if (!$movies->isEmpty())
            <header>
                <h4 class="section-title text-white Top10ShowInVN" style="font-family: Cursive;">{{ $category }}</h4>
            </header>
            <section class="row" style="overflow-y: auto;">
                <div class="col-12">
                    <div class="d-flex flex-row">
                        @foreach($movies as $movie)
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
                </div>
            </section>
        @endif
    @endforeach
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