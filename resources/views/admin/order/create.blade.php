@extends('layouts.app', ['title' => 'Tambah Order - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">TAMBAH KATEGORI</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.order.store') }}" method="POST" >
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">
              
                    <div class="mb-4">
                        <label for="id_customer" class="block text-gray-600 text-sm font-medium mb-2">Buat customer</label>
                        <select name="id_customer" id="id_customer" class="form-select w-full">
                        @foreach($customers as $customer)
                         <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <option value="{{ $customer->id_customer }}">{{ $customer->nama_customer }}</option>
                        @endforeach
                        </select>
                        @error('id_customer')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="id_menu" class="block text-gray-600 text-sm font-medium mb-2">Buat menu</label>
                        <select name="id_menu" id="id_menu" class="form-select w-full">
                        @foreach($menus as $menu)
                         <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <option value="{{ $menu->id_menu }}">{{ $menu->nama_menu }}</option>
                        @endforeach
                        </select>
                        @error('id_menu')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="text-gray-700" for="jumlah">JUMLAH DIPESAN </label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="jumlah" value="{{ old('jumlah') }}" placeholder="pesan">
                        @error('jumlah')
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