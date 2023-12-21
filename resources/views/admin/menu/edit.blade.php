@extends('layouts.app', ['title' => 'Edit Menu - Admin'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md"> <h2 class="text-lg text-gray-700 font-semibold capitalize">EDIT KATEGORI</h2> <hr class="mt-4">
        <form action="{{ route('admin.menu.update', $menu->id_menu) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT') 
            <div class="grid grid-cols-1 gap-6 mt-4"> 
                
                <div> 
                    <label class="text-gray-700" for="id_menu">KODE MENU</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="id_menu" value="{{ old('id_menu',$menu->id_menu) }}" placeholder="id menu"readonly>
                    @error('id_menu')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>
                

                <div> 
                    <label class="text-gray-700" for="nama_menu">NAMA MENU</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_menu" value="{{ old('nama_menu',$menu->nama_menu) }}" placeholder="Nama menu">
                    @error('nama_menu')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div> 
                    <label class="text-gray-700" for="deskripsi">Deskripsi</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="deskripsi" value="{{ old('deskripsi',$menu->deskripsi) }}" placeholder="deskripsi">
                    @error('deskripsi')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div> 
                    <label class="text-gray-700" for="harga">Harga</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="harga" value="{{ old('harga',$menu->harga) }}" placeholder="Harga">
                    @error('harga')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>


                
            </div>
            <div class="flex justify-start mt-4">
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">UPDATE</button>
            </div>
        </form>
    </div>
</div>
</main>
@endsection