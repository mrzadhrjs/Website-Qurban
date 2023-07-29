<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\History;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    //

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'qty' => 'required',
    //         'grade' => 'required',
    //         'bobot' => 'required',
    //         'hewan' => 'required',
    //         'user_id' => 'required',
    //         'img' => 'required'
    //     ]);

    //     $validatedData['bobot'] = str_replace(['HMT', 'A', 'B', 'C', 'D', 'E'], '', $validatedData['bobot']);
    //     $validatedData['bobot'] = str_replace('_', ' ', $validatedData['bobot']);

    //     Keranjang::create($validatedData);

    //     $validatedDataHistory = $request->validate([
    //         'qty' => 'required',
    //         'grade' => 'required',
    //         'bobot' => 'required',
    //         'hewan' => 'required',
    //         'keranjang_id' => 'required',
    //         'img' => 'required'
    //     ]);

    //     History::create($validatedDataHistory);

    //     return redirect('/');
    // }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'qty' => 'required',
        'grade' => 'required',
        'bobot' => 'required',
        'hewan' => 'required',
        'user_id' => 'required',
        'img' => 'required'
    ]);

    $validatedData['bobot'] = str_replace(['HMT', 'A', 'B', 'C', 'D', 'E'], '', $validatedData['bobot']);
    $validatedData['bobot'] = str_replace('_', ' ', $validatedData['bobot']);

    // Create a new Keranjang record
    $keranjang = Keranjang::create($validatedData);

    // Create a new History record
    $historyData = [
        'qty' => $validatedData['qty'],
        'grade' => $validatedData['grade'],
        'bobot' => $validatedData['bobot'],
        'hewan' => $validatedData['hewan'],
        'keranjang_id' => $keranjang->id,
        'img' => $validatedData['img']
    ];

    History::create($historyData);

    return redirect('/');
}
    
    

    



public function destroy($id)
{
    $keranjang = Keranjang::findOrFail($id);
    
    // Retrieve the related history records
    $historyRecords = History::where('keranjang_id', $keranjang->id)->get();
    
    // Delete the related history records
    foreach ($historyRecords as $history) {
        $history->delete();
    }
    
    // Delete the Keranjang model instance
    $keranjang->delete();

    return redirect('/');
}
}
