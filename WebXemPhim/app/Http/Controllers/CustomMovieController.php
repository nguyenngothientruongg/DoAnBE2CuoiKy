<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Psy\Readline\Hoa\Console;
use Session;
use App\Models\ListFreeMovie;
use App\Models\Movie;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomMovieController extends Controller
{
    //Xoa comment
    public function deletePost($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();
        return redirect()->back()->withSuccess('Xóa bình luận thành công');

    }
    //Them comment vao phim
    public function postComment(Request $request)
    {
        $request->validate([
            'comments' => 'required',
        ]);

        $idUser = auth()->id();

        $idMovie = $request->input('id_movie');

        $data = $request->all();
        $check = $this->createPosts($data, $idMovie, $idUser);

        return back()->withSuccess('Bình luận thành công');
    }
    //Tao comment
    public function createPosts(array $data, $idMovie, $idUser)
    {
        return Posts::create([
            'id_movie' => $idMovie,
            'id_user' => $idUser,
            'comments' => $data['comments'],
        ]);
    }

    // Cap nhat lai movie
    public function updateMovie(Request $request, $id)
    {
        $request->validate([
            'movie_name' => 'required',
            'describe' => 'required',
            'category' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif',
            'video' => 'required|mimes:mp4',
            'age_limit' => 'in:true,false',
        ]);

        $movie = Movie::find($id);
        $movie->movie_name = $request->movie_name;
        $movie->describe = $request->describe;
        $movie->category = $request->category;

        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension();
            $request->images->move(public_path('images'), $imageName);
            $movie->images = 'images/' . $imageName;
        }

        if ($request->hasFile('video')) {
            $videoName = time() . '.' . $request->video->extension();
            $request->file('video')->move(public_path('video'), $videoName);
            $movie->video = 'video/' . $videoName;
        }

        $ageLimit = $request->filled('age_limit') ? $request->age_limit === 'true' : false;

        $movie->age_limit = $ageLimit;

        $movie->save();

        return redirect()->route('admin.movie', $movie->id)->withSuccess('Sửa Phim thành công');
    }
    //Chuyen sang trang sua phim sau khi lay id
    public function editMovie($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.editMovie', compact('movie'));
    }
    //Xoa phim
    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('admin.movie')->withSuccess('Xóa phim thành công');
    }
    //Chuyen trang them phim
    public function registrationMovie()
    {
        return view('admin.registrationMovie');
    }
    //Kiem tra du lieu va them Movie vao danh sach
    public function customRegistrationMovie(Request $request)
    {
        $request->validate([
            'movie_name' => 'required',
            'describe' => 'required',
            'category' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif',
            'video' => 'required|mimes:mp4',
            'age_limit' => 'in:true,false',
        ]);

        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->file('images')->extension();
            $request->file('images')->move(public_path('images'), $imageName);
        }

        if ($request->hasFile('video')) {
            $videoName = time() . '.' . $request->file('video')->extension();
            $request->file('video')->move(public_path('video'), $videoName);
        }

        $data = $request->all();

        $ageLimit = $request->filled('age_limit') ? $data['age_limit'] : false;

        $check = $this->createMovie($data, $imageName, $videoName, $ageLimit);

        return redirect()->route('admin.movie')->withSuccess('Thêm phim thành công');
    }

    //Tao Movie
    public function createMovie(array $data, $imageName, $videoName, $ageLimit)
    {
        return Movie::create([
            'movie_name' => $data['movie_name'],
            'describe' => $data['describe'],
            'category' => $data['category'],
            'images' => isset($imageName) ? 'images/' . $imageName : null,
            'video' => isset($videoName) ? 'video/' . $videoName : null,
            'age_limit' => $ageLimit,
        ]);
    }

    //Chuyen trang Home cua Admin
    public function adminHome()
    {
        $movies = Movie::paginate(5);
        return view('admin.home', compact('movies'));
    }
    //Hien thi phim
    public function showMovie($id, $tuoi)
    {
        $movie = Movie::findOrFail($id);
        $movies = Movie::all();
        $posts = $movie->posts;
        if ($tuoi > 17 || !$movie->age_limit) {
            return view('user.showMovie', compact('movie', 'posts', 'movies'));
        }
        return redirect()->back()->withSuccess('Bạn hiện chưa đủ tuổi');

    }
    //Lay danh sach phim
    public function getListMovie()
    {
        $movies = Movie::all();
        return view('user.home ', compact('movies'));
    }


    //Dang nhap
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->permission == 1) {
                return redirect()->route('admin.movie');
            } else {
                return redirect()->intended('home')->withSuccess('Chào mừng bạn đã đến với bữa tiệc ngày hôm nay');
            }
        }

        return redirect("login")->withSuccess('Sai tài khoản hoặc mật khẩu');
    }

    //Chuyen trang dang ky
    public function registration()
    {
        return view('registration');
    }

    //Kiem tra dang ky va dang ky
    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6|confirmed',
            'date' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->file('images')->extension();
            $request->file('images')->move(public_path('images'), $imageName);
        }

        $data = $request->all();
        $check = $this->create($data, $imageName);

        return redirect("login")->withSuccess('Đăng ký thành công');
    }
    // Tao
    public function create(array $data, $imageName)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'date' => $data['date'],
            'images' => isset($imageName) ? 'images/' . $imageName : null,
            'permission' => 0,
        ]);
    }
    //Chuyen trang Home
    public function index()
    {
        return view('index');
    }
    //Chuyen trang login
    public function login()
    {
        return view('login');
    }
    //Dang xuat
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('index');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("index")->withSuccess('Đăng ký thành công');
    }
}