<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BukuModel;

class Buku extends ResourceController
{
    use ResponseTrait;

    // ==========================================
    // GET: Menampilkan semua data buku
    // ==========================================
    public function index()
    {
        $model = new BukuModel();
        
        // Join dengan tabel kategori biar nama_genre ikut tampil
        $data = $model->select('buku.*, kategori.nama_genre')
                      ->join('kategori', 'kategori.id = buku.id_kategori')
                      ->findAll();
                      
        return $this->respond($data);
    }

    // ==========================================
    // GET: Menampilkan satu data buku berdasarkan ID
    // ==========================================
    public function show($id = null)
    {
        $model = new BukuModel();
        
        $data = $model->select('buku.*, kategori.nama_genre')
                      ->join('kategori', 'kategori.id = buku.id_kategori')
                      ->where('buku.id', $id)
                      ->first();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data buku tidak ditemukan.');
        }
    }

    // ==========================================
    // POST: Menambahkan data buku baru
    // ==========================================
    public function create()
    {
        $model = new BukuModel();
        
        // Menangkap data yang dikirim dari VueJS / Postman
        $data = [
            'judul'             => $this->request->getVar('judul'),
            'id_kategori'       => $this->request->getVar('id_kategori'),
            'penulis'           => $this->request->getVar('penulis'),
            'penerbit'          => $this->request->getVar('penerbit'),
            'status_peminjaman' => $this->request->getVar('status_peminjaman')
        ];

        // Eksekusi insert ke database
        if ($model->insert($data)) {
            $response = [
                'status'   => 201,
                'messages' => 'Data buku berhasil ditambahkan.'
            ];
            return $this->respondCreated($response);
        } else {
            return $this->fail('Gagal menambahkan data buku.');
        }
    }

    // ==========================================
    // PUT: Mengupdate data buku berdasarkan ID
    // ==========================================
    public function update($id = null)
    {
        $model = new BukuModel();
        
        // Cek dulu apakah ID bukunya ada di database
        $cekData = $model->find($id);
        if (!$cekData) {
            return $this->failNotFound('Data buku tidak ditemukan.');
        }

        // Menangkap inputan untuk update (mendukung format JSON atau x-www-form-urlencoded)
        $data = $this->request->getRawInput();

        if ($model->update($id, $data)) {
            $response = [
                'status'   => 200,
                'messages' => 'Data buku berhasil diupdate.'
            ];
            return $this->respond($response);
        } else {
            return $this->fail('Gagal mengupdate data buku.');
        }
    }

    // ==========================================
    // DELETE: Menghapus data buku berdasarkan ID
    // ==========================================
    public function delete($id = null)
    {
        $model = new BukuModel();
        
        // Cek dulu apakah ID bukunya ada
        $cekData = $model->find($id);
        if (!$cekData) {
            return $this->failNotFound('Data buku tidak ditemukan.');
        }

        // Eksekusi hapus data
        if ($model->delete($id)) {
            $response = [
                'status'   => 200,
                'messages' => 'Data buku berhasil dihapus.'
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->fail('Gagal menghapus data buku.');
        }
    }
}