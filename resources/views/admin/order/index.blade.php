@extends('layouts.app', ['title' => 'Order - Admin'])


@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center">
            <button class="text-white focus:outline-none bg-gray-600 px-4 py-2 shadow-sm rounded-md">
                <a href="{{ route('admin.order.create') }}">TAMBAH</a>
            </button>
            <div class="relative mx-4">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <form action="{{ route('admin.order.index') }}" method="GET">
                    <input class="form-input w-full rounded-lg pl-10 pr-4" type="text" name="q" value="{{ request()->query('q') }}" placeholder="Search">
                </form>
            </div>

        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="bg-gray-600 w-full">
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Nama Customer</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Nama Menu</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Jumlah</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Total Harga</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Aksi</span>
                            </th>
                            
                        </tr>
                    </thead>
                    
                    <tbody class="bg-gray-200">
                    @forelse($orders as $order)
                        <tr class="border bg-white">
                           
                            <td class="px-16 py-2">{{ $order->customer->nama_customer }}</td>
                            <td class="px-16 py-2">{{ $order->menu->nama_menu }}</td>
                            <td class="px-16 py-2">{{ $order->jumlah }}</td>
                            <td class="px-16 py-2">{{ $order->total_harga }}</td>

                            <!--action untuk tombol hapus dan edit belum ditambahkan -->
                            <td class="px-10 py-2 text-center">
                                <a href="{{ route('admin.order.edit', $order->id_order) }}" class="bg-indigo-600 px-4 py-2 rounded shadow-sm text-xs text-white focus:outline-none">EDIT</a>

                                <button onClick="destroy(this.id)" id="{{ $order->id_order }}" class="bg-red-600 px-4 py-2 rounded shadow-sm text-xs text-white focus:outline-none">HAPUS</button>
                            </td>
                        </tr>
                    @empty
                        <div class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md">
                            Data Belum Tersedia!
                        </div>
                    @endforelse
                    </tbody>
                </table>
                @if ($orders->hasPages())
                <div class="bg-white p-3">
                    {{ $orders->links('vendor.pagination.tailwind') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
<script>
    function destroy(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'APAKAH KAMU YAKIN ?',
            text: "INGIN MENGHAPUS DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                //ajax delete
                jQuery.ajax({
                    url: `/admin/order/${id}`,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    }
</script>
    @endsection