<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
     //method untuk tampilkan data kategori
     public function index(){
        $menus = Menu::latest()->when(request()->q, function($menus){
             $menus = $menus->where ("nama_menu", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.menu.index", compact("menus"));
    }
    
    // method untuk membuat input kategori
    public function create(){
        return view("admin.menu.create");
    }

    //  method store untuk tambah data pada kategory
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [
            "nama_menu"=> "required|:menus",
            "deskripsi"=> "required|:menus",
            "harga"=> "required|:menus",
            
        ]);

        // data inputan simpan ke dalam table
        $menu = Menu::create([
            'nama_menu'=> $request->nama_menu,
            'deskripsi'=> $request->deskripsi,
            'harga'=> $request->harga,
        ]);

        // kondisi
        if($menu){
            return redirect()->route('admin.menu.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.menu.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
    }


     // membuat tampilan ubah, method ini untuk menampilkan data nya
     public function edit(Menu $menu){
        return view('admin.menu.edit', compact('menu'));
    }

    //method untuk mengirimkan data yang di ubah ke dalam table menus
    public function update(Request $request, Menu $menu){
        //validasi data
        $this->validate($request, [
            'nama_menu'=> 'required|:menus,nama_menu,' .$menu->id,
            'deskripsi'=> 'required|:menus,deskripsi,' .$menu->id,
            'harga'=> 'required|:menus,harga,' .$menu->id,
        ]);

            //upload data di table kategori dengan data baru
            $menu = Menu::findOrFail($menu->id_menu);
            $menu->update([
                'nama_menu' => $request->nama_menu,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                // 'image'=> $image->hashName(),
            ]);
        
        //kondisi untuk penanda berhasil atau tidak dengan memberikan pop up
        if($menu){
            return redirect()->route('admin.menu.index')->with(['success'=> 'Data Berhasil Di Ubah Ke Dalam Table Kategori']);
        }else {
            return redirect()->route('admin.menu.index')->with(['error'=> 'Data Gagal Di Ubah Ke Dalam Table Kategori']);
        }
    }
    //membuat method hapus data pada menu
    public function destroy($id){
        $menu = Menu::findOrFail($id);
        $menu->delete();

        //kondisi dalam hapus
        if($menu){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
}
