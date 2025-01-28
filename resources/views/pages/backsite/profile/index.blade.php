@extends('layouts.app')

@section('title', 'Profil')

@section('content')

    <main class="grow">
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

            {{-- Page Header --}}
            <div class="sm:flex sm:justify-between sm:items-center mb-5">

                <!-- Left: Title -->
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold mb-2">Profil</h1>
                </div>

            </div>
            {{-- End Page Header --}}

            <div class="bg-white rounded shadow p-6">
                <!-- Picture -->
                <section>
                    <div class="flex items-center mb-4">
                        <div class="mr-4">
                            <img class="w-20 h-20 rounded-full" src="{{ asset('assets/backsite/images/user.png') }}" width="80"
                                height="80" alt="Upload" />
                        </div>
                        <button
                            class="btn-sm border-gray-200 hover:border-gray-300">Ganti</button>
                    </div>
                </section>

                <!-- Business Profile -->
                <section>
                    <h3 class="text-xl leading-snug text-gray-800 dark:text-gray-100 font-bold mb-6">Ardiansyah Bisma Rizqullah</h3>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kandidat</label>
                            <input type="text" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5"
                                value="Ardiansyah Bisma Rizqullah" disabled/>
                        </div>
                        <div>
                            <label for="position"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Posisi Kandidat</label>
                            <input type="text" id="position"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5"
                                value="Web Programmer"  disabled/>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </main>

@endsection
