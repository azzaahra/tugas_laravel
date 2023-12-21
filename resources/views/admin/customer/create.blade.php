@extends('layouts.app', ['title' => 'Tambah Customer - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">TAMBAH CUSTOMER</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.customer.store') }}" method="POST" >
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">
             
                    <div>
                        <label class="text-gray-700" for="nama_customer">NAMA CUSTOMER</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_customer" value="{{ old('nama_customer') }}" placeholder="Nama customer">
                        @error('nama_penjual')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="email">EMAIL CUSTOMER</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="email" value="{{ old('email') }}" placeholder="email customer">
                        @error('nama_penjual')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="no_hp">NO HP</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="no_hp">
                        @error('no_hp')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="alamat">ALAMAT</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat">
                        @error('alamat')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    
                </div>
                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection