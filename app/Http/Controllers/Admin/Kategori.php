<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as ModelsCategory;
use Illuminate\Support\Str;

class Kategori extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', [
            'title' => 'Kategori',
            'categories' => ModelsCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', [
            'title' => 'Tambah Kategori'
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
            'description' => 'required|max:255',
            'image' => 'required|image'
        ]);

        try {

            $data = $request->except(['_token', 'files']);

            $namaFile = Str::slug($request->name) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img'), $namaFile);
            $data['image'] = $namaFile;

            ModelsCategory::create($data);
            return redirect()->back()->with('success', 'Kategori dibuat!');
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
        $category = ModelsCategory::findOrFail($id);

        return view('admin.category.edit', [
            'title' => 'Edit Kategori',
            'category' => $category
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
            'description' => 'required|max:255',
            'image' => 'nullable|image'
        ]);

        $category = ModelsCategory::findOrFail($id);

        try {
            $data = $request->except(['_token', 'files']);

            if ($request->hasFile('image')) {
                unlink(public_path() . '/img/' . $category->image);

                $namaFile = Str::slug($request->name) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('img'), $namaFile);
                $data['image'] = $namaFile;
            }

            $category->update($data);
            return redirect()->to(route('kategori.index'))->with('success', 'Kategori diperbarui!');
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
        $category = ModelsCategory::findOrFail($id);

        try {
            $category->delete();
            return redirect()->to(route('kategori.index'))->with('success', 'Kategori Dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sisi server');
        }
    }
}