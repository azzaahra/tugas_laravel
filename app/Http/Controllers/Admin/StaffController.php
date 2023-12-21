<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    //
    //method untuk tampilkan data kategori
    public function index(){
        $staffs = Staff::latest()->when(request()->q, function($staffs){
            $staffs = $staffs->where ("nama_staff", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.staff.index", compact("staffs"));
    }
    
    // method untuk membuat input kategori
    public function create(){
        return view("admin.staff.create");
    }

    //  method store untuk tambah data pada kategory
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [
            "nama_staff"=> "required|:staffs",
            "alamat"=> "required|:staffs",
            "jabatan"=> "required|:staffs",
           
           
            
        ]);
        

        // data inputan simpan ke dalam table
        $staff = Staff::create([
            'nama_staff'=> $request->nama_staff,
            'alamat'=> $request->alamat,
            'jabatan'=> $request->jabatan,

        ]);

        // kondisi
        if($staff){
            return redirect()->route('admin.staff.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.staff.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
    }


     // membuat tampilan ubah, method ini untuk menampilkan data nya
     public function edit(Staff $staff){
        return view('admin.staff.edit', compact('staff'));
    }

    //method untuk mengirimkan data yang di ubah ke dalam table staffs
    public function update(Request $request, Staff $staff){
        //validasi data
        $this->validate($request, [
            'nama_staff'=> 'required|:staffs,nama_staff,' .$staff->id,
            'alamat'=> 'required|:staffs,alamat,' .$staff->id,
            'jabatan'=> 'required|:staffs,jabatan,' .$staff->id,
        ]);

            //upload data di table kategori dengan data baru
            $staff = Staff::findOrFail($staff->id_staff);
            $staff->update([
                'nama_staff' => $request->nama_staff,
                'alamat' => $request->alamat,
                'jabatan' => $request->jabatan,
                // 'image'=> $image->hashName(),
            ]);
        
        //kondisi untuk penanda berhasil atau tidak dengan memberikan pop up
        if($staff){
            return redirect()->route('admin.staff.index')->with(['success'=> 'Data Berhasil Di Ubah Ke Dalam Table Kategori']);
        }else {
            return redirect()->route('admin.staff.index')->with(['error'=> 'Data Gagal Di Ubah Ke Dalam Table Kategori']);
        }
    }
    //membuat method hapus data pada staff
    public function destroy($id){
        $staff = Staff::findOrFail($id);
        $staff->delete();

        //kondisi dalam hapus
        if($staff){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
}
