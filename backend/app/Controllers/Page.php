<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function home()
    {
        return view('home', [
            'title'   => 'Home',
            'content' => 'Selamat datang di website sederhana.'
        ]);
    }

    public function about()
    {
        return view('about', [
            'title'   => 'Halaman About',
            'content' => 'Ini adalah halaman about yang menjelaskan tentang isi halaman ini.'
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'title'   => 'Halaman Kontak',
            'content' => 'Silakan hubungi kami melalui email, telepon, atau media sosial resmi.'
        ]);
    }

    public function faqs()
    {
        return view('faqs', [
            'title'   => 'Halaman FAQ',
            'content' => 'Berikut adalah beberapa pertanyaan yang sering diajukan.'
        ]);
    }

    public function tos()
    {
        echo "ini halaman Term of Services";
    }
}