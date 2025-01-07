<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
    ]);
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'name' => 'Reza Andika',
    ]);
})->name('about');

Route::get('/posts', function () {
    return view('posts', [
        'title' => 'Blog',
        'posts' => [
            [
                'id' => '1',
                'slug' => 'judul-artikel-1',
                'title' => 'Judul Article 1',
                'author' => 'Reza Andika',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id assumenda velit eaque asperiores vitae sunt natus expedita, cumque porro sequi qui incidunt quo, est ullam? Tenetur perferendis mollitia error quidem.'
            ],
            [
                'id' => '2',
                'slug' => 'judul-artikel-2',
                'title' => 'Judul Article 2',
                'author' => 'Fadilla',
                'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas atque dignissimos pariatur cumque dolore, facere deserunt quae id alias, voluptatem, omnis accusantium vel perferendis sunt earum maxime saepe repellendus vero.'
            ]
        ]
    ]);
})->name('blog');

Route::get('/posts/{slug}', function ($slug) {
    $posts = [
        [
            'id' => '1',
            'slug' => 'judul-artikel-1',
            'title' => 'Judul Article 1',
            'author' => 'Reza Andika',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id assumenda velit eaque asperiores vitae sunt natus expedita, cumque porro sequi qui incidunt quo, est ullam? Tenetur perferendis mollitia error quidem.'
        ],
        [
            'id' => '2',
            'slug' => 'judul-artikel-2',
            'title' => 'Judul Article 2',
            'author' => 'Fadilla',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas atque dignissimos pariatur cumque dolore, facere deserunt quae id alias, voluptatem, omnis accusantium vel perferendis sunt earum maxime saepe repellendus vero.'
        ]
        ];

        $post = Arr::first($posts, function ($post) use ($slug) {
            return $post['slug'] == $slug;
        });

        return view('post', [
            'title' => 'Single Post',
            'post' => $post
        ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title' => 'Contact',
    ]);
})->name('contact');
