<?php

namespace App\Http\Controllers;
use App\Models\Grade;
use Illuminate\Http\Request;

class DashboardGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard.grade.index', [
            'grade' => Grade::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.grade.create', [
            'hewan' => Grade::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate(['grade' => 'required|unique:grade']);
    
        Grade::create($validatedData);
    
        return redirect('/dashboard/grade')->with('success', 'New Grade has been added!');
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
    public function edit(Grade $grade)
    {
        //
        return view('dashboard.grade.edit', [
            'grade' => $grade
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
        $rules = [
            'grade' => 'required',
        ];
        

        $validatedData = $request->validate($rules);
        Grade::where('id', $grade->id)
            ->update($validatedData);
            
        return redirect('/dashboard/grade')->with('success', 'Grade has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
        Grade::destroy($grade->id);
        return redirect('/dashboard/grade')->with('success', 'Grade has been deleted!');
    }
}
