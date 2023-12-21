<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    //method untuk tampilkan data kategori
    public function index(){
        $customers = Customer::latest()->when(request()->q, function($customers){
            $customers = $customers->where ("nama_customer", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.customer.index", compact("customers"));
    }
    
    // method untuk membuat input kategori
    public function create(){
        return view("admin.customer.create");
    }

    //  method store untuk tambah data pada kategory
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [
            "nama_customer"=> "required|:customers",
            "email"=> "required|:customers",
            "no_hp"=> "required|:customers",
            "alamat"=> "required|:customers",
            
        ]);

        // data inputan simpan ke dalam table
        $customer = Customer::create([
            'nama_customer'=> $request->nama_customer,
            'email'=> $request->email,
            'no_hp'=> $request->no_hp,
            'alamat'=> $request->alamat,
        ]);

        // kondisi
        if($customer){
            return redirect()->route('admin.customer.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.customer.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
    }


     // membuat tampilan ubah, method ini untuk menampilkan data nya
     public function edit(Customer $customer){
        return view('admin.customer.edit', compact('customer'));
    }

    //method untuk mengirimkan data yang di ubah ke dalam table customers
    public function update(Request $request, Customer $customer){
        //validasi data
        $this->validate($request, [
            'nama_customer'=> 'required|:customers,nama_customer,' .$customer->id,
            'email'=> 'required|:customers,email,' .$customer->id,
            'no_hp'=> 'required|:customers,no_hp,' .$customer->id,
            'alamat'=> 'required|:customers,alamat,' .$customer->id,
        ]);

            //upload data di table kategori dengan data baru
            $customer = Customer::findOrFail($customer->id_customer);
            $customer->update([
                'nama_customer' => $request->nama_customer,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                // 'image'=> $image->hashName(),
            ]);
        
        //kondisi untuk penanda berhasil atau tidak dengan memberikan pop up
        if($customer){
            return redirect()->route('admin.customer.index')->with(['success'=> 'Data Berhasil Di Ubah Ke Dalam Table Kategori']);
        }else {
            return redirect()->route('admin.customer.index')->with(['error'=> 'Data Gagal Di Ubah Ke Dalam Table Kategori']);
        }
    }
    //membuat method hapus data pada customer
    public function destroy($id){
        $customer = Customer::findOrFail($id);
        $customer->delete();

        //kondisi dalam hapus
        if($customer){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
}
