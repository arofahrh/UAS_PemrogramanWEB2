<?php

namespace App\Cells; 

use App\Models\ArtikelModel;

class ArtikelTerkini
{
    public function render()
    {
        $model = new ArtikelModel();
        // Mengambil 5 artikel terbaru
        $data['artikel'] = $model->orderBy('id', 'DESC')->findAll(5);
        
        // Pastikan view-nya juga sudah ada di app/Views/components/artikel_terkini.php
        return view('components/artikel_terkini', $data);
    }
}