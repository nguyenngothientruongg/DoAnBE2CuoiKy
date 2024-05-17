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
        @if($countries->isEmpty())
            <h3 class="text-white">Quốc gia bạn tìm không tồn tại.</h3>
        @else
            <h3 class="text-white">Danh sách Quốc gia</h3>
            <table class="table table-bordered table-striped table-light text-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Quốc gia</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td>{{ $country->id }}</td>
                            <td> {{ $country->name }}</td>
                            <td>
                                <a href="{{ route('admin.editCountries', $country->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa-regular fa-pen-to-square" style="font-size: 20px; color: black;"></i></a>
                                <form action="{{ route('admin.deleteCountries', $country->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có muốn xoá quốc gia này?')">
                                        <i class="fa-solid fa-trash" style="font-size: 20px;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $countries->appends(request()->all())->links('custom-pagination') }}
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