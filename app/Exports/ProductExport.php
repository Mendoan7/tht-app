<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        // Query produk dengan filter
        $products = Product::with('category')
            ->when($this->filters['search'] ?? null, function ($query, $search) {
                $search = strtolower($search); // Konversi ke huruf kecil
                return $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
            })
            ->when($this->filters['category'] ?? null, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->get();

        return view('exports.products', compact('products'));
    }
}
