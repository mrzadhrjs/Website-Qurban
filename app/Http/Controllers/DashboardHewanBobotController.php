<?php


namespace App\Http\Controllers;
use App\Models\Grade;
use App\Models\GradeBobot;
use App\Models\Bobot;
use App\Models\Hewan;
use App\Models\HewanBobot;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardHewanBobotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $bobot = new Bobot;
        $bobot->bobot = $request->input('bobot');
        $bobot->harga = $request->input('harga');
        $bobot->save();

        $gradebobot = new GradeBobot;
        $gradebobot->grade_id = $request->input('grade_id');
        $gradebobot->bobot_id = $bobot->id;
        $gradebobot->save();

        $hewanbobot = new HewanBobot;
        $hewanbobot->hewan_id = $request->input('hewan_id');
        $hewanbobot->bobot_id = $bobot->id;
        $hewanbobot->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //

        $bobot = Bobot::where('id', $request->input('id'))->first();
        // Retrieve the related history records
        
        // Delete the Keranjang model instance
        $bobot->delete();
    
        return redirect()->back();
    }
}
