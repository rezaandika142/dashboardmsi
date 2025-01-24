<?php


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LtfuController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LtfuImportController;
use App\Http\Controllers\HomeController;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');


// Halaman Tentang
Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'name' => 'Reza Andika',
    ]);
})->name('about');

// Blog
Route::get('/posts', function () {
    return view('posts', [
        'title' => 'Blog',
        'posts' => [
            [
                'id' => '1',
                'slug' => 'judul-artikel-1',
                'title' => 'Judul Artikel 1',
                'author' => 'Reza Andika',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...',
            ],
            [
                'id' => '2',
                'slug' => 'judul-artikel-2',
                'title' => 'Judul Artikel 2',
                'author' => 'Fadilla',
                'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit...',
            ],
        ]
    ]);
})->name('blog');

// Blog - Single Post
Route::get('/posts/{slug}', function ($slug) {
    $posts = [
        [
            'id' => '1',
            'slug' => 'judul-artikel-1',
            'title' => 'Judul Artikel 1',
            'author' => 'Reza Andika',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...',
        ],
        [
            'id' => '2',
            'slug' => 'judul-artikel-2',
            'title' => 'Judul Artikel 2',
            'author' => 'Fadilla',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit...',
        ],
    ];

    $post = Arr::first($posts, function ($post) use ($slug) {
        return $post['slug'] === $slug;
    });

    return view('post', [
        'title' => 'Single Post',
        'post' => $post,
    ]);
});

// Halaman Kontak
Route::get('/contact', function () {
    return view('contact', [
        'title' => 'Contact',
    ]);
})->name('contact');

// Resource Controller untuk LTFU
Route::resource('ltfu', LtfuController::class);

// Import LTFU - Halaman Upload dan Proses Impor

Route::post('/ltfu/import', [LtfuImportController::class, 'import'])->name('ltfu.import');

Route::get('/ltfu/import', [LtfuController::class, 'showImportForm'])->name('ltfu.import');
Route::post('/ltfu/import', [LtfuController::class, 'importStore'])->name('ltfu.import.store');

// Chatbot
// Route::post('/chatbot/generate', [ChatbotController::class, 'generateResponse']);
// Route::post('/chatbot/generate', [ChatbotController::class, 'generateResponse'])->name('chatbot.generate');
Route::post('/chatbot', [ChatbotController::class, 'handleChat'])->name('chatbot.handle');
// Route::post('/chatbot', function (Request $request) {
//     $message = $request->input('message');
//     // Logic untuk mendapatkan respons chatbot
//     $reply = "Ini respons dari chatbot untuk pesan: \"$message\".";
//     return response()->json(['status' => 'success', 'reply' => $reply]);
// });
// Route::post('/chatbot', function (Request $request) {
//     $message = $request->input('message');
//     $reply = chatbot_reply($message);

//     return response()->json(['reply' => $reply]);
// });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
