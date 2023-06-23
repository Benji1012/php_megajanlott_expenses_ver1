<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function deleteExpense(Expense $expense){
        if(auth()->user()->id == $expense['user_id']){
            $expense->delete();
        }

        return redirect('/');
    }




    public function updateExpense(Expense $expense, Request $request){
        if(auth()->user()->id !== $expense['user_id']){
            return redirect('/');
        }
        $incomingFields = $request->validate([
            'store'=>'required',
            'amount'=>'required',
            'when'=>'required',
            'paymentType'=>'required',
            'type'=>'required',
            'comment' => 'nullable'
        ]);

        $incomingFields['store'] = strip_tags($incomingFields['store']);
        $incomingFields['amount'] = strip_tags($incomingFields['amount']);
        $incomingFields['when'] = strip_tags($incomingFields['when']);
        $incomingFields['paymentType'] = strip_tags($incomingFields['paymentType']);
        $incomingFields['type'] = strip_tags($incomingFields['type']);
        $incomingFields['comment'] = strip_tags($incomingFields['comment']);
        $incomingFields['user_id'] = auth()->id();

        $expense->update($incomingFields);
        return redirect('/');

    }

    public function showEditScreen(Expense $expense){

        if(auth()->user()->id !== $expense['user_id']){
            return redirect('/');
        }

        return view('edit-expense', ['expense' => $expense]);
    }


    public function createExpense(Request $request){
        $incomingFields = $request->validate([
            'store'=>'required',
            'amount'=>'required',
            'when'=>'required',
            'paymentType'=>'required',
            'type'=>'required',
            'comment' => 'nullable'
            
        ]);
        $incomingFields['store'] = strip_tags($incomingFields['store']);
        $incomingFields['amount'] = strip_tags($incomingFields['amount']);
        $incomingFields['when'] = strip_tags($incomingFields['when']);
        $incomingFields['paymentType'] = strip_tags($incomingFields['paymentType']);
        $incomingFields['type'] = strip_tags($incomingFields['type']);
        $incomingFields['comment'] = strip_tags($incomingFields['comment']);
        $incomingFields['user_id'] = auth()->id();
        Expense::create($incomingFields);
        return redirect('/');
    }
}
