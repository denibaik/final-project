<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $products = [];

        if (!$request->has('search'))
            $products = Product::all();
        else
            $products = Product::whereHas('category', function ($q) use ($request) {
                $q->where('name', 'like', '%' . urldecode($request->search) . '%');
            })
                ->where('name', 'like', '%' . urldecode($request->search) . '%')
                ->get();

        return view('home', [
            'products' => $products,
            'search' => $request->has('search'),
            'categories' => Category::all()
        ]);
    }

    function get_produk(Request $request): JsonResponse
    {
        abort_if(!$request->ajax(), 404);

        return response()->json(Product::find($request->id));
    }

    function beli(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        try {
            Transaction::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::user()->id,
                'status' => 'Pending'
            ]);
            return redirect('/')->with('success', "Pembelian berhasil, silahkan screenshot kode pembayaran ini sebagai bukti.<br>Total : Rp " . number_format($product->price + random_int(111, 999), 0, ',', '.') . " (dengan kode unik)<br>Rekening : 32342-2134-1222<br>A.N : " . config('app.name') . " Official<br>Pesanan akan langsung dikirim setelah transfer masuk");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sisi Server!');
        }
    }
}
