<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                'string',
                Rule::unique('products', 'name')->ignore($this->route('product')), // ignore current product
            ],
            'buy_price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'buy_price.required' => 'Harga beli wajib diisi.',
            'buy_price.integer' => 'Harga beli harus berupa angka.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka.',
            'image.image' => 'File yang diunggah harus berupa gambar format png dan jpg.',
            'image.mimes' => 'Gambar harus berupa format jpeg, png, jpg.',
            'image.max' => 'Ukuran gambar maksimal 100kb.',
        ];
    }
}
