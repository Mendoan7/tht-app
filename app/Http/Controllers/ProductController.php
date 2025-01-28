<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request) {
                $search = strtolower($request->search); // Konversi menjadi huruf kecil
                return $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
            })
            ->when($request->category, function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            })
            ->paginate(10);

        return view('pages.backsite.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.backsite.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Hitung harga jual
        $data['sell_price'] = $data['buy_price'] * 1.3;

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Product::create($data);

        return redirect()->route('backsite.product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('pages.backsite.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validated();

        // Hitung harga jual
        $data['sell_price'] = $data['buy_price'] * 1.3;

        // Proses update gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        // Update data produk
        $product->update($data);

        return redirect()->route('backsite.product.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('backsite.product.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function exportExcel(Request $request)
    {
        $filters = $request->only(['search', 'category']);

        return Excel::download(new ProductExport($filters), 'products.xlsx');
    }
}
