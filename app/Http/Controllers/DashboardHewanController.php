<?php

namespace App\Http\Controllers;
use App\Models\Grade;
use App\Models\GradeBobot;
use App\Models\Bobot;
use App\Models\Hewan;
use App\Models\HewanGrade;

use App\Models\Transaction;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class DashboardHewanController extends Controller
{
    public function index()
    {
        return view('dashboard.hewan.index', [
            'hewan' => Hewan::all(),
            'bobot' => Bobot::all(),
            'grade' => Grade::all(),
            'hewangrade' => HewanGrade::all(),
            'gradebobot' => GradeBobot::all(),
            'transaksi' => Transaction::all(),
            'gb' => GradeBobot::all()
        ]);
    }

    public function create()
    {   
        return view('dashboard.hewan.create', [
            'hewan' => Hewan::all()
        ]);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required|unique:hewan',
        'qty' => 'required',
        'coverimg' => 'image'
    ]);
    if ($request->file('coverimg')) {
        $validatedData['coverimg'] = $request->file('coverimg')->store('foto-hewan');
    }

    Hewan::create($validatedData);

    return redirect('/dashboard/hewan')->with('success', 'New Hewan has been added!');
}


    public function show(Hewan $hewan)
    {
        // return view('dashboard.komik.show', [
        //     'title' => $komik->judul,
        //     'slash' => '/',
        //     'loc' => '',
        //     'komik' => $komik,
        //     'chapter' => Chapter::all()
        // ]);
    }

    public function edit(Hewan $hewan)
    {
        return view('dashboard.hewan.edit', [
            'hewan' => $hewan
        ]);
    }
    

    public function update(Request $request, Hewan $hewan)
{
    $rules = [
        'nama' => 'required',
        'qty' => 'required',
        'coverimg' => 'image'
    ];

    $validatedData = $request->validate($rules);

    if ($request->hasFile('coverimg')) {
        // If a new image is uploaded, store it and update the coverimg value
        $validatedData['coverimg'] = $request->file('coverimg')->store('foto-hewan');
    } else {
        // If no new image is uploaded, keep the existing coverimg value
        $validatedData['coverimg'] = $request->oldcoverimg;
    }

    Hewan::where('id', $hewan->id)->update($validatedData);

    return redirect('/dashboard/hewan')->with('success', 'Hewan has been updated!');
}


    public function destroy(Hewan $hewan)
    {

        // if($komik->gambar){
        //     Storage::delete($komik->gambar);
        // }
        if($hewan->coverimg){
            Storage::delete($hewan->coverimg);
        }


        Hewan::destroy($hewan->id);
        return redirect('/dashboard/hewan')->with('success', 'Hewan has been deleted!');
        // Komik::destroy($komik->id);
        // return redirect('/dashboard/komik')->with('success', 'Komik has been deleted!');
    }
}