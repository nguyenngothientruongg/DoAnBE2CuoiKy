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

    .banner {
        display: flex;

    }

    .item-comment {
        background-color: #171717;
        border-radius: 10px;
        padding: 10px 0px;
        margin: 0px 3px;
    }

    .avatar-user {
        border-radius: 5px;
    }

    .avatar-user {
        margin-left: 10px;
    }

    .name-user {
        font-family: "Gill Sans", sans-serif;
        font-size: 15;
        font-weight: 700;
        letter-spacing: -1px;
        color: #669698;
    }

    .comments-of-user {
        font-family: "Gill Sans", sans-serif;
        font-size: 15;
        font-weight: 500;
        letter-spacing: -1px;
        color: #404040;
    }

    .bg-comments {
        background-color: rgba(23, 23, 23, 1);
        border-radius: 20px
    }

    .form-control {
        background-color: #171717;
        border: #767676 1px solid;
    }

    .tb-comment {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border-bottom: 1px solid #dddddd;
        text-align: left;
        padding: 30px;
    }

    th {
        color: rgba(195, 19, 19, 1);
        text-align: center;
    }

    td {
        color: #fff;
        text-align: center;
    }
</style>
<div class="row">
    <!-- Avatar Container -->
    <div class="col-md-3">
        <div class="avatar-container"
            style="position: relative; width: 300px; height: 200px; flex-direction: column; overflow: hidden; background-color: #202020; margin: 30px 30px; display: flex; justify-content: center; align-items: center; border-radius: 10%;">
            <img src="{{ asset($movie->images) }}" alt="User Avatar" style="width: 250px; height: auto;">
        </div>
    </div>

    <!-- Information Box -->
    <div class="col-md-9">
        <div class="avatar-container"
            style="position: relative; width: 700px; height: 530px; flex-direction: column; overflow: hidden; background-color: #202020; margin: 30px 100px; display: flex; padding-left: 50px">
            <div style="margin-top: 30px;">
                <h4 style="margin-bottom: 70px; margin-left: 30px; margin-top: 30px; color: white;">Chi tiết phim
                </h4>
                <p style="font-size: 20px; margin-bottom: 40px; margin-left: 50px; font-family: cursive; color: white;">
                    <strong>Tên phim: </strong> {{ $movie->movie_name }}
                </p>
                <p style="font-size: 20px; margin-bottom: 40px; margin-left: 50px; font-family: cursive; color: white;">
                    <strong>Mô tả: </strong> {{ $movie->describe }}
                </p>
                <p style="font-size: 20px; margin-bottom: 40px; margin-left: 50px; font-family: cursive; color: white;">
                    <strong>Thể loại:</strong> {{ $movie->category }}
                </p>
                <p style="font-size: 20px; margin-bottom: 40px; margin-left: 50px; color: white;">
                    <strong>Giới hạn độ tuổi:</strong>
                    @if ($movie->age_limit === true)
                        Có
                    @else
                        Không
                    @endif
                </p>


                <p style="font-size: 20px; margin-bottom: 40px; margin-left: 50px;  color: white;">
                    <strong>Quốc gia:</strong> {{ $movie->countries->name }}
                </p>

            </div>
        </div>
    </div>
</div>


<section class="banner mt-5">
    <div class="container bg-comments">
        @if($comments->isEmpty())
            <div class="alert box-comment text-center mt-4 p-3 text-light" role="alert">
                <strong>Chưa có bình luận</strong>
            </div>
        @else
            <table class="tb-comment ">
                <tr>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Thơi gian</th>
                    <th>Thực hiện</th>
                </tr>
                @foreach ($comments as $comment) 
                    <div class="show-comments mt-2">
                        <tr>
                            <td class="item-comments">{{$comment->user->name}}</td>
                            <td class="item-comments">{{$comment->user->email}}</td>
                            <td class="item-comments">{{$comment->comments}}</td>
                            <td class="item-comments">{{$comment->created_at}}</td>
                            <td class="item-comments-action">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('delCommentByAd', ['id' => $comment->id])}}"
                                    onclick="return confirm('Bạn có muốn commnent phim này?')"><i
                                        class="fa-solid fa-trash text-white"></i></a>
                            </td>
                        </tr>
                        <tr>
                    </div>
                @endforeach
            </table>
            <div class="paginate mt-5">{{ $comments->links('custom-pagination') }}</div>
        @endif
    </div>
</section>
@endsection