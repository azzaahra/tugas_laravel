<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     // Menampilkan daftar order
     public function index(){
        $orders = Order::latest()->when(request()->q, function($orders){
            $orders = $orders->where ("nama_menu", "like", "%". request()->q ."%");
       })->paginate(10);
       $orders = Order::with(['customer', 'menu'])->paginate(10);
       return view("admin.order.index", compact("orders"));
    }
    
    
    // Menampilkan form untuk membuat order baru
    public function create()
    {
        $customers = Customer::all();
        $menus = Menu::all();

        return view('admin.order.create', compact('customers', 'menus'));
    }

    // Menyimpan data order baru
    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required|exists:customers,id_customer',
            'id_menu' => 'required|exists:menus,id_menu',
            'jumlah' => 'required|integer|min:1',
            // Sesuaikan aturan validasi sesuai kebutuhan
        ]);
    
        // Hitung harga berdasarkan jumlah dan harga menu
        $menus = Menu::findOrFail($request->id_menu);
        $harga = $menus->harga * $request->jumlah;
    

        $order = Order::create([
            'id_customer' => $request->id_customer,
            'id_menu' => $request->id_menu,
            'jumlah' => $request->jumlah,
            'total_harga' => $harga, // Simpan harga di sini
            // Sesuaikan kolom lainnya sesuai kebutuhan
        ]);
        if($order){
            return redirect()->route('admin.order.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.order.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
        
    }

    // Menampilkan form untuk mengedit order
    public function edit(Order $order)
    {
        $orders = Order::findOrFail($order->id_order);
        $customers = Customer::all();
        $menus = Menu::all();

        return view('admin.order.edit', compact('order', 'customers', 'menus'));

    }

    // Menyimpan data order yang sudah diubah
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'id_customer' => 'required|exists:customers,id_customer',
            'id_menu' => 'required|exists:menus,id_menu',
            'jumlah' => 'required|integer|min:1',
            // Sesuaikan aturan validasi sesuai kebutuhan
        ]);
    
        $order = Order::findOrFail($order->id_order);
    
        // Hitung harga berdasarkan jumlah dan harga menu
        $menu = Menu::findOrFail($request->id_menu);
        $harga = $menu->harga * $request->jumlah;
    
        // Update data order
        $order->update([
            'id_customer' => $request->id_customer,
            'id_menu' => $request->id_menu,
            'jumlah' => $request->jumlah,
            'total_harga' => $harga,  // Simpan harga di sini
            // Sesuaikan kolom lainnya sesuai kebutuhan
        ]);

        // Redirect ke halaman index dengan pesan sukses
        if($order){
            return redirect()->route('admin.order.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.order.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
    }

    public function destroy($id){
        $order = Order::findOrFail($id);
        $order->delete();

        //kondisi dalam hapus
        if($order){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }

    // Tambahkan metode lainnya sesuai kebutuhan
}
