@extends('dashboard')
<style>
    html,
    body {
        height: 100%;
        font-family: Andale Mono, monospace;
    }

    .table,
    .table-bordered,
    .table-striped,
    .table-light,
    .text-dark {
        font-family: Andale Mono, monospace;
    }

    .table thead th,
    .table tbody td {
        text-align: center;
        /* Optional: Center align text in columns */
    }

    .table thead th:nth-child(1),
    .table tbody td:nth-child(1) {
        width: 5%;
        /* Adjust width for the ID column */
    }

    .table thead th:not(:nth-child(1)),
    .table tbody td:not(:nth-child(1)) {
        width: 19%;
        /* Adjust width for other columns */
    }

    .table img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .bg {
        background-color: #343a40;
    }

    .text-white {
        color: #fff;
    }

    .btn i {
        vertical-align: middle;
    }
</style>
@section('content')
<main class="bg" style="padding: 20px; min-height: 100vh;">
    <div style="overflow-x: auto;">
        @if($movies->isEmpty())
            <h3 class="text-white">Phim bạn tìm không tồn tại.</h3>
        @else
            <h3 class="text-white">Danh sách Phim</h3>
            <table class="table table-bordered table-striped table-light text-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên phim</th>
                        <th>Mô tả</th>
                        <th>Thể loại</th>
                        <th>Quốc gia</th>
                        <th>Mác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr>
                            <td>{{ $movie->id }}</td>
                            <td>
                                @if($movie->images)
                                    <img src="{{ asset($movie->images) }}" alt="Avatar"
                                        style="max-width: 100px; max-height: 100px;">
                                @else
                                    <p>No image found.</p>
                                @endif
                                {{ $movie->movie_name }}
                            </td>
                            <td>{{ $movie->describe }}</td>
                            <td>{{ $movie->category }}</td>
                            <td>
                                {{ $movie->countries->name }}
                            </td>

                            <td>
                                @if($movie->age_limit)
                                    18+
                                @else
                                    18-
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $movies->appends(request()->all())->links('custom-pagination') }}
        @endif
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
@endsection