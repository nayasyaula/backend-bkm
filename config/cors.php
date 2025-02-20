<?php

return [
    'paths' => ['api/*'], // Atur agar hanya API yang kena CORS
    'allowed_methods' => ['*'], // Izinkan semua metode (GET, POST, dll.)
    'allowed_origins' => ['*'], // Izinkan semua domain (ubah sesuai kebutuhan)
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Izinkan semua header
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false, // Set ke `true` jika pakai autentikasi berbasis cookie
];
