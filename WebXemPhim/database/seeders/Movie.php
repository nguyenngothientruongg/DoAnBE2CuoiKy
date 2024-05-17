<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Movie extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'movie_name' => 'Conan: Ngôi sao 5 cánh triệu đỏ',
                'describe' => 'Ông trùm suy luận, kẻ phá vỡ các lời biện minh xảo trá: Sherlockholmes',
                'category' => 'Hình sự',
                'images' => 'images/conan.jpg',
                'video' => 'video/conan.mp4',
                'age_limit' => false,
            ],
            [
                'movie_name' => 'Avenger infinity war',
                'describe' => 'Cuộc chiến vô cực',
                'category' => 'Khoa học viễn tưởng',
                'images' => 'images/avenger.jpg',
                'video' => 'video/avenger.mp4',
                'age_limit' => true,
            ],
            [
                'movie_name' => 'Doraemon: Nobita và bản giao hưởng địa cầu',
                'describe' => 'Cuộc phiêu lưu của con chồn và 4 người bạn',
                'category' => 'Hoạt hình',
                'images' => 'images/doraemon.jpg',
                'video' => 'video/doraemon.mp4',
                'age_limit' => false,
            ],
            [
                'movie_name' => 'Quật mộ trùng ma',
                'describe' => 'Chưa xem nên không biết mô tả như thế nào',
                'category' => 'Kinh dị',
                'images' => 'images/quatmo.jpg',
                'video' => 'video/quatmo.mp4',
                'age_limit' => true,
            ],
            [
                'movie_name' => 'Sherlockholmes phiêu lưu kí',
                'describe' => 'Chưa xem nên không biết mô tả như thế nào',
                'category' => 'Hình sự',
                'images' => 'images/sherlockholmes.jpg',
                'video' => 'video/sherlockholmes.mp4',
                'age_limit' => true,
            ],
            [
                'movie_name' => 'Nhà có 5 nàng dâu movie',
                'describe' => 'Yotsubaaaa thua thế *** nào được',
                'category' => 'Lãng mạn',
                'images' => 'images/5nangdau.jpg',
                'video' => 'video/5nangdau.mp4',
                'age_limit' => false,
            ],
            [
                'movie_name' => 'Trở lại tuổi 18',
                'describe' => 'Đầu thai trở lại 18 tuổi để cua lại vợ cũ',
                'category' => 'Lãng mạn',
                'images' => 'images/18again.jpeg',
                'video' => 'video/18again.mp4',
                'age_limit' => false,
            ],
            [
                'movie_name' => 'Nguời mẹ tồi của tôi',
                'describe' => 'Hành trình trả thù của thằng nhóc 30 tuổi',
                'category' => 'Tâm lý',
                'images' => 'images/thegodbadmother.jpg',
                'video' => 'video/thegodbadmother.mp4',
                'age_limit' => false,
            ],
            [
                'movie_name' => 'Gửi em nguời bất tử',
                'describe' => 'Đơn giản thì anh không thể chết',
                'category' => 'Phiêu lưu',
                'images' => 'images/toyoureternity.jpg',
                'video' => 'video/toyoureternity.mp4',
                'age_limit' => true,
            ],
            [
                'movie_name' => 'Your name',
                'describe' => 'Cua gái vượt cả thời đại',
                'category' => 'Lãng mạn',
                'images' => 'images/yourname.jpg',
                'video' => 'video/yourname.mp4',
                'age_limit' => false,
            ],
            [
                'movie_name' => 'Tuổi trẻ của tháng năm',
                'describe' => 'Tất cả tại lũ hàn xẻng',
                'category' => 'Lãng mạn',
                'images' => 'images/youthofmay.jpg',
                'video' => 'video/youthofmay.mp4',
                'age_limit' => false,
            ]
        ];
        DB::table('movie')->insert($movies);
    }
}
