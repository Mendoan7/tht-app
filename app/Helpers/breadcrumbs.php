<?php

if (!function_exists('generateBreadcrumbs')) {
    function generateBreadcrumbs()
    {
        $breadcrumbs = [];
        $segments = request()->segments(); // Mendapatkan segmen URL
        $url = '';
        
        // Menghapus 'backsite' dari segmen pertama jika ada
        if ($segments[0] == 'backsite') {
            array_shift($segments); // Menghapus segmen pertama yang 'backsite'
        }

        // Membentuk breadcrumb dan memastikan prefix backsite tetap ada di URL
        foreach ($segments as $key => $segment) {
            $url .= '/' . $segment;

            // Mengecek jika segmen adalah ID produk
            if (is_numeric($segment) && $key === count($segments) - 2) {
                // Jika segmen adalah ID produk, ambil nama produk dari database
                $product = \App\Models\Product::find($segment);
                $segment = $product ? $product->name : 'Product';
            }
            
            // Menambahkan breadcrumb
            $breadcrumbs[] = [
                'name' => ucwords(str_replace('-', ' ', $segment)), // Menjadikan nama breadcrumb human-readable
                'url' => $key < count($segments) - 1 
                    ? url('backsite' . $url)  // Menambahkan 'backsite' di setiap URL breadcrumb
                    : null, // URL hanya untuk segmen sebelumnya
            ];
        }

        return $breadcrumbs;
    }
}


