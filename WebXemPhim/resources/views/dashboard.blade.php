<!DOCTYPE html>
<html>

<head>
    <title>ChillWithM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome-free-6.5.1-web/css/all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <style>
        html,
        body {
            overflow-x: hidden;
            height: 100%;
        }

        ;

        .button-link {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 7px;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .button-link:hover {
            background-color: #FF0000;
            color: white;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var currentUrl = window.location.href;
            var homeLink = document.getElementById("homeLink");
            var genreLink = document.getElementById("genreLink");
            var homeUserLink = document.getElementById("homeUserLink");
            var categoryUserLink = document.getElementById("categoryUserLink");
            var userLink = document.getElementById("userLink");

            function setActiveLink() {
                if (currentUrl.includes("{{ route('admin.movie') }}")) { 
                    homeLink.classList.add("active");
                    homeLink.style.color = "white";
                    homeLink.style.borderBottom = "2px solid white";
                } else if (currentUrl.includes("{{route('admin.registrationMovie')}}")) { 
                    genreLink.classList.add("active");
                    genreLink.style.color = "white";
                    genreLink.style.borderBottom = "2px solid white";
                } else if (currentUrl.includes("{{ route('user.movie') }}")) {
                    homeUserLink.classList.add("active");
                    homeUserLink.style.color = "white";
                    homeUserLink.style.borderBottom = "2px solid white";
                } else if (currentUrl.includes("{{route('user.category')}}")){
                    categoryUserLink.classList.add("active");
                    categoryUserLink.style.color = "white";
                    categoryUserLink.style.borderBottom = "2px solid white";
                }
                else if (currentUrl.includes("{{route('admin.userList')}}")){
                    userLink.classList.add("active");
                    userLink.style.color = "white";
                    userLink.style.borderBottom = "2px solid white";
                }
            }

            setActiveLink();
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black; height: 80px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)"
                style="color: #FF0000; font-weight: 900; font-size: 24px; font-family: Honk;">ChillWithM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                @guest
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link mx-3" href="{{ route('index') }}"
                                style="color: white; border-bottom: 2px solid white;">Trang chủ</a>
                        </li>
                    </ul>
                    
                    <a class="btn mx-3" style="background-color: white; color: #FF0000;" href="{{ route('login') }}">Đăng
                        Nhập</a>
                @elseif (Auth::user()->permission == '1')
                    <div class="collapse navbar-collapse" id="mynavbar">

                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link mx-3" id="homeLink" href="{{ route('admin.movie') }}">Danh sách phim</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link me-3" id="genreLink" href="{{ route('admin.registrationMovie') }}">Thêm
                                    phim</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link mx-3" id="userLink" href="{{ route('admin.userList') }}">Danh sách User</a>
                            </li>
                        </ul>

                        <form class="d-flex" style="margin-top: 18px">
                            <input class="form-control me-2" type="text" placeholder="Nhập phim cần tìm...">
                            <button class="btn text-white"
                                style="width: 121px; background-color: white; background-color: #FF0000;" type="button">Tìm
                                kiếm</button>
                        </form>
                        <a class="btn mx-3" style="background-color: white; color: #FF0000;"
                            href="{{ route('signout') }}">Đăng Xuất</a>
                        <i class="fa-solid fa-user-tie"
                            style="color: white; font-size: 37px; margin-left: 20px; margin-right: 10px;"></i>
                    </div>
                @else
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link mx-3" id="homeUserLink" href="{{ route('user.movie') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-3" id="categoryUserLink" href="{{route('user.category')}}">Thể loại</a>
                        </li>
                    </ul>
                    <form class="d-flex" style="margin-top: 18px">
                        <input class="form-control me-2" type="text" placeholder="Nhập phim cần tìm...">
                        <button class="btn text-white"
                            style="width: 121px; background-color: white; background-color: #FF0000;" type="button">Tìm
                            kiếm</button>
                    </form>
                    <a class="btn mx-3" style="background-color: white; color: #FF0000;" href="{{ route('signout') }}">Đăng
                        Xuất</a>
                    @if(Auth::check())
                        <img src="{{ asset(Auth::user()->images) }}" alt="User Avatar"
                            style="width: 43px; height: 43px; margin-left: 20px; margin-right: 10px; border-radius: 50%;">
                    @else
                        <i class="fa-regular fa-circle-user"
                            style="color: white; font-size: 37px; margin-left: 20px; margin-right: 10px;"></i>
                    @endif

                @endguest     
            </div>
        </div>
    </nav>
    @yield('content')
</body>

</html>