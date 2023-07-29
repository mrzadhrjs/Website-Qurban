<?php

namespace App\Http\Controllers;


use App\Models\History;
use App\Models\HistoryTransaksi;
use App\Models\Bobot;
use App\Models\User;
use App\Models\Transaction;

use Illuminate\Http\Request;

class DashboardUserController extends Controller
{

    public function index()
    {
        return view('dashboard.user.index', [
            'user' => User::all(),
            'bobot' => Bobot::all(),
            'history' => History::all(),
            'ht' => HistoryTransaksi::all(),
            'transaksi' => Transaction::all()

        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        
        //
    }

    public function edit(User $user)
    {
        //
    }

        public function update(Request $request, $id)
    {
        // Retrieve the transaction from the database
        $transaction = Transaction::findOrFail($id);

        // Update the verification status based on the submitted form data
        $transaction->verification = $request->input('verification');
        $transaction->save();

        // Perform any additional logic or redirection as needed

        return redirect()->back()->with('success', 'Verification status updated successfully');
    }


    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/user')->with('success', 'Komik has been deleted!');
    }
}
