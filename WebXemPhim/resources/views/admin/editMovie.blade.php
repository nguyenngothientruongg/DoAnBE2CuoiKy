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
                    <h3 class="card-header text-center text-white">Sửa thông tin phim</h3>
                    <div class="card-body">
                        <form action="{{ route('admin.updateMovie', $movie->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Tên phim" id="movie_name" class="form-control"
                                    name="movie_name" value="{{ $movie->movie_name }}" required autofocus>
                                @if ($errors->has('namovie_nameme'))
                                    <span class="text-danger">{{ $errors->first('movie_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Mô tả" id="describe" class="form-control"
                                    name="describe" value="{{ $movie->describe }}" required autofocus>
                                @if ($errors->has('describe'))
                                    <span class="text-danger">{{ $errors->first('describe') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Thể loại" id="category" class="form-control"
                                    name="category" value="{{ $movie->category }}" required>
                                @if ($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="video" class="text-white">Poster</label>
                                <input type="file" id="Ảnh" class="form-control" name="images"
                                    enctype="multipart/form-data" required>
                                @if ($errors->has('images'))
                                    <span class="text-danger">{{ $errors->first('images') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="video" class="text-white">Video</label>
                                <input type="file" id="video" class="form-control" name="video" accept="video/*"
                                    required>
                                @if ($errors->has('video'))
                                    <span class="text-danger">{{ $errors->first('video') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="age_limit" class="text-white">Age Limit</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="age_limit" name="age_limit"
                                        value="true">
                                    <label class="form-check-label text-white" for="age_limit">18+</label>
                                </div>
                                @if ($errors->has('age_limit'))
                                    <span class="text-danger">{{ $errors->first('age_limit') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-block text-white"
                                    style="background-color: red; font-family: cursive;">Sửa phim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection