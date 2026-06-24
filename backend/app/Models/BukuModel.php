<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Field yang boleh diisi lewat API
    protected $allowedFields    = ['judul', 'id_kategori', 'penulis', 'penerbit', 'status_peminjaman'];
}