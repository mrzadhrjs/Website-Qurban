<?php

namespace App\Http\Controllers;
use App\Models\Grade;
use App\Models\GradeBobot;
use App\Models\Bobot;
use App\Models\Hewan;
use App\Models\HewanGrade;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardHewanGradeController extends Controller
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
        $hewangrade = new HewanGrade;
        $hewangrade->hewan_id = $request->input('hewan_id');
        if ($request->grade_id === null) {
            return redirect()->back(); // or you can use `exit()` to terminate the script execution
        }
        $hewangrade->grade_id = $request->grade_id;
        $hewangrade->save();
        


        return redirect()->back()->with('success', 'New Grade has been added to Hewan!');
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
        $hewangrade = HewanGrade::where("hewan_id", $request->input('hewan_id'))->where('grade_id', $request->input('grade_id'))->first();
        $hewangrade->delete();
            return redirect()->back()->with('success', 'Grade from Hewan successful deleted!');
       
    }

}
