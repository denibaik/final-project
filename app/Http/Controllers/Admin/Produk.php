<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Produk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index', [
            'title' => 'Produk',
            'products' => Product::with('category')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'title' => 'Tambah Produk',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        try {

            $data = $request->except(['_token', 'files']);

            $namaFile = Str::slug($request->name) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img/sale'), $namaFile);
            $data['image'] = $namaFile;

            Product::create($data);
            return redirect()->back()->with('success', 'Produk dibuat!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sisi server');
        }
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
        $product = Product::findOrFail($id);

        return view('admin.product.edit', [
            'title' => 'Edit Kategori',
            'product' => $product,
            'categories' => Category::all()
        ]);
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
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $product = Product::findOrFail($id);

        try {
            $data = $request->except(['_token', 'files']);

            if ($request->hasFile('image')) {
                unlink(public_path() . '/img/sale/' . $product->image);

                $namaFile = Str::slug($request->name) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('img'), $namaFile);
                $data['image'] = $namaFile;
            }

            $product->update($data);
            return redirect()->to(route('produk.index'))->with('success', 'Produk diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sisi server');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        try {
            $product->delete();
            return redirect()->to(route('produk.index'))->with('success', 'Produk Dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sisi server');
        }
    }
}