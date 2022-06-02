<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pemesanan;
use App\PemesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    //
    public function store(Request $request) {
        //nama, email, password
        $validasi = Validator::make($request->all(), [
            'user_id' => 'required',
            'total_item' => 'required',
            'nama_penerima' => 'required',
            'nomor_telephone' => 'required',
            'total_pembayaran' => 'required',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $kode_transaksi = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $status = "VERIFIKASI";



        $dataTransaksi = array_merge($request->all(), [
            'kode_transaksi' => $kode_transaksi,
            'status' => $status,
            'tanggal_pemesanan_makanan_minuman' => now()
        ]);

        \DB::beginTransaction();
        $transaksi = Pemesanan::create($dataTransaksi);
        foreach ($request->produks as $produk) {
            $detail = [
                'id_pemesanan' => $transaksi->id_pemesanan_makanan_minuman,
                'id_makanan_minuman' => $produk['id_makanan_minuman'],
                'kuantitas' => $produk['kuantitas'],
                'total_harga' => $produk['total_harga']
            ];
            $transaksiDetail = PemesananDetail::create($detail);
        }

        if (!empty($transaksi) && !empty($transaksiDetail)) {
            \DB::commit();
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transaksi' => collect($transaksi)
            ]);
        } else {
            \DB::rollback();
            return $this->error('Transaksi gagal');
        }
    }

    public function history($id_user) {
        $transaksis = Pemesanan::with(['user'])->whereHas('user', function ($query) use ($id_user) {
            $query->where('id_user','=',$id_user);
        })->orderBy("id_pemesanan_makanan_minuman", "desc")->get();

        foreach ($transaksis as $transaksi) {
            $details = $transaksi->details;
            foreach ($details as $detail) {
                $detail->produk;
            }
        }

        if (!empty($transaksis)) {
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transaksis' => collect($transaksis)
            ]);
        } else {
            $this->error('Transaksi gagal');
        }
    }

}
