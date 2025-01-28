<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                'max:255',
                Rule::unique('products')->where(function ($query) {
                    return $query->whereRaw('LOWER(name) = ?', [strtolower($this->name)]);
                })
            ],
            'buy_price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'name.required' => 'Nama produk wajib diisi.',
            'name.unique' => 'Nama produk sudah terdaftar. Silakan gunakan nama lain.',
            'buy_price.required' => 'Harga beli produk wajib diisi.',
            'buy_price.integer' => 'Harga beli harus berupa angka.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok produk harus berupa angka.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Gambar harus memiliki format jpg, png, atau jpeg.',
            'image.max' => 'Ukuran gambar maksimal 100kb.',
        ];
    }
}
