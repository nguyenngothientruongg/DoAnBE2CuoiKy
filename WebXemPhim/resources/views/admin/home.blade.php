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
    <h3 class="text-white">Danh sách Phim</h3>
    <div style="overflow-x: auto;">
        <table class="table table-bordered table-striped table-light text-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên phim</th>
                    <th>Mô tả</th>
                    <th>Thể loại</th>
                    <th>Mác</th>
                    <th>Chức năng</th>
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
                            @if($movie->age_limit)
                                18+
                            @else
                                18-
                            @endif
                        </td>
                        
                        <td>
                            <a href="#" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-info"
                                    style="font-size: 20px;"></i></a>
                            <a href="{{ route('admin.editMovie', $movie->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa-regular fa-pen-to-square" style="font-size: 20px; color: black;"></i></a>
                            <form action="{{ route('admin.deleteMovie', $movie->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có muốn xoá phim này?')"><i class="fa-solid fa-trash"
                                        style="font-size: 20px;"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $movies->links('custom-pagination') }}
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