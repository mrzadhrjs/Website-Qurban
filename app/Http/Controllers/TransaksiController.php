<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Keranjang;
use App\Models\History;
use App\Models\HistoryTransaksi;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'total' => 'required',
            'foto' => 'image'
        ]);
    
        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('bukti-pembayaran');
        }
    
        $transaction = Transaction::create($validatedData);
    
        // Get the authenticated user's Keranjang
        $keranjangs = Keranjang::where('user_id', auth()->user()->id)->get();
        $history = History::all();
        // Create KeranjangTransaksi for each Keranjang associated with the user
            foreach ($keranjangs as $keranjang) {
                foreach ($history->where('keranjang_id', $keranjang->id) as $k) {
                    # code...
                
                $keranjangTransaksi = new HistoryTransaksi();
                $keranjangTransaksi->transaction_id = $transaction->id;
                $keranjangTransaksi->history_id = $k->id;
                $keranjangTransaksi->save();
    
            // Delete the Keranjang record after creating KeranjangTransaksi
            $keranjang->delete();
            }
        }
    
        return redirect('/');
    }
    


}
