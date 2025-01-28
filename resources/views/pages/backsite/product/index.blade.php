@extends('layouts.app')

@section('title', 'Produk')

@section('content')

    <main class="grow">
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

            {{-- Page Header --}}
            <div class="sm:flex sm:justify-between sm:items-center mb-5">

                {{-- Left Title --}}
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold mb-2">Daftar Produk</h1>
                    @include('components.backsite.breadcrumb')
                </div>
                {{-- End Left Title --}}

            </div>
            {{-- End Page Header --}}

            {{-- Start Component Header --}}
            <div class="sm:flex sm:justify-between sm:items-center mb-5">
                {{-- Left Side --}}
                <div class="flex items-center gap-4 mb-4 sm:mb-0">
                    <form method="GET" action="{{ route('backsite.product.index') }}" class="max-w-lg mx-auto">
                        <div class="flex">
                            <!-- Dropdown Kategori -->
                            <button id="dropdown-button" data-dropdown-toggle="dropdown"
                                class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                                type="button">
                                {{ request()->category ? $categories->find(request()->category)->name : 'Semua' }}
                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="dropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                                    <!-- Option for All Categories -->
                                    <li>
                                        <button type="submit" name="category" value=""
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100">
                                            Semua
                                        </button>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li>
                                            <button type="submit" name="category" value="{{ $category->id }}"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">
                                                {{ $category->name }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Input Pencarian -->
                            <div class="relative w-full">
                                <input type="search" id="search-dropdown" name="search" value="{{ request()->search }}"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-violet-500"
                                    placeholder="Cari barang" />
                                <button type="submit"
                                    class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-violet-500 rounded-e-lg border border-violet-500 hover:bg-violet-700 focus:ring-4 focus:outline-none focus:ring-violet-300 dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Right Side --}}
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="{{ route('product.export', request()->query()) }}"
                        class="btn bg-green-700 text-green-100 hover:bg-green-600 dark:bg-green-100 dark:text-green-600 dark:hover:bg-white flex items-center gap-2">
                        <svg class="fill-current shrink-0" width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M14 0H2C.9 0 0 .9 0 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V2c0-1.1-.9-2-2-2zM6.7 10.7l-1.4-1.4-1.4 1.4c-.4.4-1 .4-1.4 0-.4-.4-.4-1 0-1.4l1.4-1.4-1.4-1.4c-.4-.4-.4-1 0-1.4s1-.4 1.4 0l1.4 1.4 1.4-1.4c.4-.4 1-.4 1.4 0s.4 1 0 1.4L7.4 8l1.4 1.4c.4.4.4 1 0 1.4-.4.4-1 .4-1.4 0zM14 14H8v-2h6v2zm0-3H8v-2h6v2zM14 8H8V6h6v2zm0-3H8V3h6v2z" />
                        </svg>
                        <span>Export Excel</span>
                    </a>
                    <a href="{{ route('backsite.product.create') }}"
                        class="btn bg-violet-700 text-violet-100 hover:bg-violet-600 dark:bg-violet-100 dark:text-violet-600 dark:hover:bg-white">
                        <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="max-xs:sr-only">Tambah Produk</span>
                    </a>
                </div>
            </div>
            {{-- End Component Header --}}

            {{-- Start Table --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl mb-8">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full dark:text-gray-300">
                        {{-- Table Header --}}
                        <thead
                            class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900/20 border-t border-b border-gray-100 dark:border-gray-700/60">
                            <tr>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Image</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nama Produk</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Kategori Produk</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Harga Beli</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Harga Jual</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Stok Produk</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700/60">
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            style="width: 50px; height: 50px;">
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        {{ $product->category->name }}
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        {{ number_format($product->buy_price) }}
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        {{ number_format($product->sell_price) }}
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        {{ $product->stock }}
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                        <div class="flex justify-center space-x-4">
                                            <a href="{{ route('backsite.product.edit', $product->id) }}"
                                                class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 rounded-full">
                                                <span class="sr-only">Edit</span>
                                                <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                    <path
                                                        d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('backsite.product.destroy', $product->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-600 rounded-full">
                                                    <span class="sr-only">Delete</span>
                                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                        <path d="M13 15h2v6h-2zM17 15h2v6h-2z" />
                                                        <path
                                                            d="M20 9c0-.6-.4-1-1-1h-6c-.6 0-1 .4-1 1v2H8v2h1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V13h1v-2h-4V9zm-6 1h4v1h-4v-1zm7 3v9H11v-9h10z" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            {{-- Pagination --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm text-gray-500 text-center sm:text-left">
                    Showing <span class="font-medium text-gray-600 dark:text-gray-300">
                        {{ $products->firstItem() }}</span> to <span class="font-medium text-gray-600 dark:text-gray-300">
                        {{ $products->lastItem() }}</span> of <span class="font-medium text-gray-600 dark:text-gray-300">
                        {{ $products->total() }}</span> results
                </div>
                <nav class="flex" role="navigation" aria-label="Navigation">
                    <ul class="inline-flex -space-x-px text-sm">
                        {{-- Previous Page Link --}}
                        <li>
                            @if ($products->onFirstPage())
                                <span
                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg">Previous</span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}"
                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                            @endif
                        </li>

                        {{-- Page Number Links --}}
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center px-3 h-8 {{ $page == $products->currentPage() ? ' text-violet-600 border border-gray-300 bg-violet-100 hover:bg-violet-300' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        <li>
                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                            @else
                                <span
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg">Next</span>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
            {{-- End Pagination --}}

        </div>
    </main>

@endsection
