<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    function index()
    {
        return view('admin.dashboard', [
            'transaction' => Transaction::with(['user', 'product.category'])->get(),
            'users' => User::where('role', '!=', 'Admin')->orderBy('id', 'desc')->get()
        ]);
    }

    public function edit($id)
    {
        $trx = Transaction::findOrFail($id);

        return view('admin.edit', [
            'title' => 'Edit Transaksi',
            'trx' => $trx
        ]);
    }

    public function edit_process(Request $request, $id)
    {
        $trx = Transaction::findOrFail($id);

        try {
            $trx->update([
                'status' => $request->status
            ]);
            return redirect()->to(route('admin'))->with('success', 'Transaksi Diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sisi server : ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $trx = Transaction::findOrFail($id);

        try {
            $trx->delete();
            return redirect()->to(route('admin'))->with('success', 'Transaksi Dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sisi server');
        }
    }
}
