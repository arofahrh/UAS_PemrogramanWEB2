<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        // Mengirim data untuk view
        $data = [
            'title' => 'About Us',
            'content' => 'Selamat datang di halaman About kami. Kami adalah tim yang berfokus pada pengembangan aplikasi web dengan menggunakan teknologi terbaru.'
        ];

        return view('about', $data); // Memanggil view 'about' dengan data yang dikirim
    }
}