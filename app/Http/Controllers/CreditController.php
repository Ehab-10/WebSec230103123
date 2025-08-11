<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CreditController extends Controller
{
    // عرض الفورم لإضافة رصيد
    public function addCreditForm(Request $request)
    {
        $customers = User::role('user')->get();
    
        $selectedUserId = $request->query('user_id');
    
        return view('credit.add', compact('customers', 'selectedUserId'));
    }
    

    // معالجة إضافة الرصيد
        public function addCredit(Request $request)
        {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'amount' => 'required|numeric|min:1',
            ]);

            $user = User::findOrFail($request->user_id);

            if (!$user->hasRole('user')) {
                return redirect()->back()->with('error', 'Selected user is not a customer.');
            }

            $user->credit += $request->amount;
            $user->save();

            return redirect()->back()->with('success', 'Credit added successfully.');
        }
}
