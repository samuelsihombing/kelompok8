<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::simplePaginate(10);
        return view('produk',['produk'=>$produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = new Produk;
        $produk->name = $request->name;
        $produk->category_id = $request->category_id;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;

        $image = $request->image;
        $namafile = time().'.'.$image->getClientOriginalExtension();
        $image->move('images/' ,$namafile);

        $produk->image =$namafile;
        $produk->save();
        return redirect('produk')->with('success','Produk Telah di tambahkan');
    }
 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('produk.edit',compact('produk','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //
         $produk = Produk::find($id);
         if ($request->has('image')) {
             $produk->name = $request->get('name');
         $produk->harga = $request->get('harga');
         $produk->deskripsi = $request->get('deskripsi');
         
         $image =  $request->image;
         $namafile = time().'.'.$image->getClientOriginalExtension();
         $produk->image = $namafile;
         
         
         
         }else{
             $produk->name = $request->get('name');
             $produk->harga = $request->get('harga');
             $produk->deskripsi = $request->get('deskripsi');
         }
         $produk->update();
         return redirect('produk')->with('success','Data Produk berhsil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //fngsi untuk mengapus data
       $produk = Produk::find($id);
       $produk->delete();
       return redirect('produk')->with('success','Data Berhasil di hapus');
    }
}