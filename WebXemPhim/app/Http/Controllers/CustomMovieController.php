<?php
namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Movie;
use App\Models\Posts;
use App\Models\User;
use App\Models\MovieWatched;
use Illuminate\Support\Facades\Auth;

class CustomMovieController extends Controller
{
    public function searchMovie()
    {

        $movies = [];
        $key = request()->key;
        $movies = Movie::where('movie_name', 'like', '%' . $key . '%')->orWhere('category', 'like', '%' . $key . '%')
            ->paginate(5);
        return view('user.search', compact('movies'));

    }
    public function registrationCountries()
    {
        return view('admin.registrationCountries');
    }
    public function customRegistrationCountries(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();

        $check = $this->createCountries($data);

        return redirect()->route('admin.countriesList')->withSuccess('Thêm quốc gia thành công');
    }

    //Tao Movie
    public function createCountries(array $data)
    {
        return Countries::create([
            'name' => $data['name'],
        ]);
    }
    public function updateCountries(Request $request, $id)
    {
        $countries = Countries::find($id);
        $countries->name = $request->name;

        $countries->save();

        return redirect()->route('admin.countriesList', $countries->id)->withSuccess('Sửa quốc gia thành công');

    }
    //Chuyen sang trang sua thong tin user
    public function editCountries($id)
    {
        $countries = Countries::find($id);
        return view('admin.editCountries', compact('countries'));
    }
    public function deleteCountries($id)
    {
        $countries = Countries::findOrFail($id);
        $countries->delete();
        return redirect()->route('admin.countriesList')->withSuccess('Xóa quốc gia thành công');
    }
    public function countriesList()
    {
        $countries = [];
        $key = request()->key;
        $countries = Countries::where('name', 'like', '%' . $key . '%')
            ->paginate(5);
        return view('admin.countries', compact('countries'));

    }
    public function deleteCommentByAdmin($id)
    {
        $comment = Posts::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Bình luận đã được xóa.');
        ;

    }
    public function detailMovieAdmin($id)
    {
        $movie = Movie::findOrFail($id);
        $movies = Movie::all();
        $comments = Posts::where('id_movie', $movie->id)->orderBy('id', 'DESC')->paginate(5);
        return view('admin.detailMovie', compact('movie', 'movies', 'comments'));
    }
    public function deleteMovieWatched()
    {
        $user = Auth::user();
        $user->movies()->detach();

        return redirect()->route('user.profileUser', $user->id)->withSuccess('Đã xoá danh sách phim đã xem');
    }
    //Tao phim da xem
    public function createMovieWatched($idMovie, $idUser)
    {
        return MovieWatched::create([
            'id_user' => $idMovie,
            'id_movie' => $idUser,
        ]);
    }
    //Cap nhap lai User
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        $user->phone = $request->phone;

        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension();
            $request->images->move(public_path('images'), $imageName);
            $user->images = 'images/' . $imageName;
        }

        $user->save();

        return redirect()->route('user.profileUser', $user->id)->withSuccess('Sửa thông tin thành công');

    }
    //Chuyen sang trang sua thong tin user
    public function editUser($id)
    {
        return view('user.editUser');
    }
    //Trang ca nhan
    public function profileUser()
    {
        $user = Auth::user();

        $watchedMovies = $user->movies()->orderByDesc('created_at')->get();
        return view('user.profileUser', compact('watchedMovies'));
    }

    //Xoa User
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $idUser = auth()->id();
        if (!$user) {
            return back()->withSuccess('Không tìm thấy User');
        } else if ($idUser === $user->id) {
            return back()->withSuccess('Không thể xóa Admin');
        }
        $user->delete();
        return back()->withSuccess('Xóa User thành công');
    }
    //Lay danh sach user o trang admin
    public function adminUserList()
    {
        $users = User::paginate(5);
        return view('admin.userList', compact('users'));
    }
    //Lay danh sach the loai phim
    public function getListCategoryMovie()
    {
        $categories = [
            'Hành động' => Movie::where('category', 'Hành động')->get(),
            'Phiêu lưu' => Movie::where('category', 'Phiêu lưu')->get(),
            'Kinh dị' => Movie::where('category', 'Kinh dị')->get(),
            'Hài' => Movie::where('category', 'Hài')->get(),
            'Tâm lý' => Movie::where('category', 'Tâm lý')->get(),
            'Lãng mạn' => Movie::where('category', 'Lãng mạn')->get(),
            'Khoa học viễn tưởng' => Movie::where('category', 'Khoa học viễn tưởng')->get(),
            'Hình sự' => Movie::where('category', 'Hình sự')->get(),
            'Hoạt hình' => Movie::where('category', 'Hoạt hình')->get(),
            'Thần thoại' => Movie::where('category', 'Thần thoại')->get(),
        ];

        return view('user.category', compact('categories'));
    }
    //Xoa comment
    public function deletePost($id)
    {
        $post = Posts::find($id);

        if (!$post) {
            return back()->withSuccess('Không tìm thấy bình luận');
        }

        $post->delete();
        return back()->withSuccess('Xóa bình luận thành công');

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
            'id_countries' => 'required',
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

        $movie->id_countries = $request->id_countries;

        $movie->save();

        return redirect()->route('admin.movie', $movie->id)->withSuccess('Sửa Phim thành công');
    }
    //Chuyen sang trang sua phim sau khi lay id
    public function editMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $countries = Countries::all();
        return view('admin.editMovie', compact('movie'), compact('countries'));
    }
    //Xoa phim
    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        if (!$movie) {
            return back()->withSuccess('Không tìm thấy phim');
        }
        $movie->delete();
        return back()->withSuccess('Xóa phim thành công');
    }
    //Chuyen trang them phim
    public function registrationMovie()
    {
        $countries = Countries::all();
        return view('admin.registrationMovie', compact('countries'));
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
            'id_countries' => 'required',
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
            'id_countries' => $data['id_countries']
        ]);
    }

    //Chuyen trang Home cua Admin
    public function adminHome()
    {
        $movies = [];
        $key = request()->key;
        $movies = Movie::where('movie_name', 'like', '%' . $key . '%')->orWhere('category', 'like', '%' . $key . '%')
            ->paginate(5);
        return view('admin.home', compact('movies'));
    }
    //Hien thi phim
    public function showMovie($id, $tuoi)
    {
        $idUser = auth()->id();

        $check = $this->createMovieWatched($idUser, $id);

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