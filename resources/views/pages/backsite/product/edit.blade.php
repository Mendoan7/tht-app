@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

    <main class="grow">
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

            {{-- Page Header --}}
            <div class="sm:flex sm:justify-between sm:items-center mb-5">

                {{-- Left Title --}}
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold mb-2">Edit Produk</h1>
                    @include('components.backsite.breadcrumb')
                </div>
                {{-- End Left Title --}}

            </div>
            {{-- End Page Header --}}

            <div class="bg-white rounded shadow p-6">
                <form action="{{ route('backsite.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="category_id" id="category_id"
                                class="bg-gray-50 border @error('category_id') border-red-500 @else border-gray-300 @enderror border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>Pilih kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}"
                                class="bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukan Nama Barang" required />
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <label for="buy_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Beli</label>
                            <input type="text" name="buy_price" id="buy_price" value="{{ $product->buy_price }}"
                                class="bg-gray-50 border @error('buy_price') border-red-500 @else border-gray-300 @enderror  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Harga Beli" required oninput="calculateSellPrice()" />
                            @error('buy_price')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="sell_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Jual</label>
                            <input type="text" name="sell_price" id="sell_price" value="{{ $product->sell_price }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Harga Jual" readonly />
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stok Barang</label>
                            <input type="number" name="stock" id="stock" value="{{ $product->stock }}"
                                class="bg-gray-50 border @error('stock') border-red-500 @else border-gray-300 @enderror  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Stock" required />
                            @error('stock')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="label_image" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Image
                        </label>
                        <!-- Input file -->
                        <input id="image" type="file" name="image" accept="image/*" class="hidden" />

                        <!-- Upload area -->
                        <label for="image"
                            class="flex flex-col items-center justify-center w-full h-48 border-2 @error('image') border-red-500 @else border-gray-300 @enderror border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 transition relative overflow-hidden">
                            <!-- Preview image -->
                            <img id="preview"
                                class="hidden w-32 h-32 object-cover rounded-lg absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                alt="Preview">

                            @if ($product->image)
                                <div id="current-image" class="mt-4">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image"
                                        class="w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif
                        </label>

                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-4 mt-4">
                        <a href="{{ route('backsite.product.index') }}"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">
                            Batalkan
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <script>
        function calculateSellPrice() {
            var buyPrice = document.getElementById('buy_price').value;
            var sellPriceField = document.getElementById('sell_price');

            if (buyPrice) {
                var buyPriceNum = parseInt(buyPrice, 10);
                var sellPrice = buyPriceNum + (buyPriceNum * 0.30);
                sellPriceField.value = sellPrice;
            } else {
                sellPriceField.value = '';
            }
        }
    </script>

    <script>
        const imageInput = document.getElementById('image');
        const previewImage = document.getElementById('preview');
        const currentImage = document.getElementById('current-image'); // Referensi ke gambar lama
        const uploadText = document.getElementById('upload-text');

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    // Update preview image source
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    // Hide current image if it exists
                    if (currentImage) {
                        currentImage.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
                if (currentImage) {
                    currentImage.style.display = 'block'; // Show current image again
                }
            }
        });
    </script>

@endsection
