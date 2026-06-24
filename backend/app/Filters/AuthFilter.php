<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Kasih Jalur VIP: Kalau tujuannya ke /login, biarin lewat tanpa dicegat!
        if (strpos($request->getUri()->getPath(), 'login') !== false) {
            return;
        }

        // 2. Selain login (kayak nambah/ngedit buku), wajib dicek tokennya
        $header = $request->getServer('HTTP_AUTHORIZATION');

        if (!$header) {
            // Kalau nggak ada token, tendang dan kasih error 401
            $response = service('response');
            $response->setJSON([
                'status'   => 401,
                'messages' => '401 Unauthorized: Akses ditolak! Anda tidak membawa Token valid.'
            ]);
            return $response->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosongin aja
    }
}