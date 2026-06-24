<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Auth extends ResourceController
{
    public function login()
    {
        $model = new UserModel();
        
        // 1. Tangkap inputan username & password dari Vue (Karena formatnya RAW JSON)
        $json = $this->request->getJSON();
        
        // Pake ?? '' biar aman dari error kalau seandainya data kosong
        $username = $json->username ?? '';
        $password = $json->password ?? '';

        // 2. Cari user berdasarkan username di database
        $user = $model->where('username', $username)->first();

        // Kalau username nggak ada di database
        if (!$user) {
            return $this->respond(['error' => 'Username tidak ditemukan!'], 401);
        }

        // 3. Cek kecocokan password 
        // (KARENA KITA PAKE TEKS BIASA 'admin123', JADI PAKE SAMA DENGAN (==))
        if ($password == $user['password']) {
            
            // ==========================================
            // BIKIN JWT TOKEN MANUAL (Aman dari Error 500)
            // ==========================================
            $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
            
            // Data yang mau diselipin di dalam Token
            $payload = json_encode([
                'user_id'  => $user['id'], 
                'username' => $user['username'], 
                // Pake fallback ?? 'user' jaga-jaga kalau kolom role kehapus/ga ada
                'role'     => $user['role'] ?? 'user', 
                'exp'      => time() + 3600 // Token berlaku selama 1 jam
            ]);
            
            $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
            $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
            
            // Kunci Rahasia buat gembok Token
            $secret = 'rahasia_elibrary_123';
            $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
            $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
            
            // Token siap disajikan!
            $token = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

            return $this->respond([
                'status'   => 200,
                'messages' => 'Mantap Arofah, Login Berhasil!',
                'token'    => $token
            ], 200);

        } else {
            // Kalau passwordnya ngasal
            return $this->respond(['error' => 'Password salah bro!'], 401);
        }
    }
}