<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{   
    /*public function createPdf(Expense $expense, Request $request) {
        // retreive all records from db
        $expense =[];
        $userId = auth()->id();

        $storeFilter = strip_tags($request->input('storeFilter'));
        $amountBiggerFilter = strip_tags($request->input('amountBiggerFilter'));
        $amountSmallerFilter = strip_tags($request->input('amountSmallerFilter'));
        $whenFromFilter = strip_tags($request->input('whenFromFilter'));
        $whenToFilter = strip_tags($request->input('whenToFilter'));
        $paymentTypeFilter = strip_tags($request->input('paymentTypeFilter'));
        $typeFilter = strip_tags($request->input('typeFilter'));
       
       $query = DB::table('expenses')->where('user_id', $userId);
       if (!empty($storeFilter)) {
            $query->where('store', $storeFilter);
        }

        if (!empty($amountBiggerFilter)) {
            $query->where('amount', '>', $amountBiggerFilter);
        }

        if (!empty($amountSmallerFilter)) {
            $query->where('amount', '<', $amountSmallerFilter);
        }

        if (!empty($whenFromFilter)) {
            $query->where('when', '>=', $whenFromFilter);
        }

        if (!empty($whenToFilter)) {
            $query->where('when', '<=', $whenToFilter);
        }

        if ($paymentTypeFilter!=='All') {
            $query->where('paymentType', $paymentTypeFilter);
        }

        if ($typeFilter!== 'All') {
            $query->where('type', $typeFilter);
        }       
            $expenses= $query->get();
        // share data to view
        view()->share('expenses',$expenses);
        //$pdf = PDF::loadView('pdf_view', $expenses);
        
        $pdf = PDF::loadView('pdf', compact('expenses'));
        
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }

    public function filterExpenseDiagram(Expense $expense, Request $request){
        $expense =[];
        $userId = auth()->id();

        $storeFilter = strip_tags($request->input('storeFilter'));
        $amountBiggerFilter = strip_tags($request->input('amountBiggerFilter'));
        $amountSmallerFilter = strip_tags($request->input('amountSmallerFilter'));
        $whenFromFilter = strip_tags($request->input('whenFromFilter'));
        $whenToFilter = strip_tags($request->input('whenToFilter'));
        $paymentTypeFilter = strip_tags($request->input('paymentTypeFilter'));
        $typeFilter = strip_tags($request->input('typeFilter'));
       
       $query = DB::table('expenses')->where('user_id', $userId);
       if (!empty($storeFilter)) {
            $query->where('store', $storeFilter);
        }

        if (!empty($amountBiggerFilter)) {
            $query->where('amount', '>', $amountBiggerFilter);
        }

        if (!empty($amountSmallerFilter)) {
            $query->where('amount', '<', $amountSmallerFilter);
        }

        if (!empty($whenFromFilter)) {
            $query->where('when', '>=', $whenFromFilter);
        }

        if (!empty($whenToFilter)) {
            $query->where('when', '<=', $whenToFilter);
        }

        if ($paymentTypeFilter!=='All') {
            $query->where('paymentType', $paymentTypeFilter);
        }

        if ($typeFilter!== 'All') {
            $query->where('type', $typeFilter);
        }
        
                    
                    
            $expenses= $query->get();
          //  echo $expenses;
            return view('diagram', ['expenses' => $expenses]);
    }

    public function filterExpense(Expense $expense, Request $request){
        $expense =[];
        $userId = auth()->id();

        $storeFilter = strip_tags($request->input('storeFilter'));
        $amountBiggerFilter = strip_tags($request->input('amountBiggerFilter'));
        $amountSmallerFilter = strip_tags($request->input('amountSmallerFilter'));
        $whenFromFilter = strip_tags($request->input('whenFromFilter'));
        $whenToFilter = strip_tags($request->input('whenToFilter'));
        $paymentTypeFilter = strip_tags($request->input('paymentTypeFilter'));
        $typeFilter = strip_tags($request->input('typeFilter'));
       
       $query = DB::table('expenses')->where('user_id', $userId);
       if (!empty($storeFilter)) {
            $query->where('store', $storeFilter);
        }

        if (!empty($amountBiggerFilter)) {
            $query->where('amount', '>', $amountBiggerFilter);
        }

        if (!empty($amountSmallerFilter)) {
            $query->where('amount', '<', $amountSmallerFilter);
        }

        if (!empty($whenFromFilter)) {
            $query->where('when', '>=', $whenFromFilter);
        }

        if (!empty($whenToFilter)) {
            $query->where('when', '<=', $whenToFilter);
        }

        if ($paymentTypeFilter!=='All') {
            $query->where('paymentType', $paymentTypeFilter);
        }

        if ($typeFilter!== 'All') {
            $query->where('type', $typeFilter);
        }
        
                    
                    
            $expenses= $query->get();
           // echo $expenses;
        return view('home', ['expenses' => $expenses]);

    }*/

    public function createPdf(Request $request)
{
    // Retrieve filtered expenses
    $expenses = $this->getFilteredExpenses($request);
    
    // Share data to view
    view()->share('expenses', $expenses);

    // Generate and download PDF
    $pdf = PDF::loadView('pdf', compact('expenses'));
    return $pdf->download('pdf_file.pdf');
}

public function filterExpenseDiagram(Request $request)
{
    // Retrieve filtered expenses
    $expenses = $this->getFilteredExpenses($request);
    echo $expenses;
    // Return view with filtered expenses
    return view('diagram', ['expenses' => $expenses]);
}

public function filterExpense(Request $request)
{
    // Retrieve filtered expenses
    $expenses = $this->getFilteredExpenses($request);

    // Return view with filtered expenses
    return view('home', ['expenses' => $expenses]);
}

private function getFilteredExpenses(Request $request)
{
    $userId = auth()->id();

    $storeFilter = strip_tags($request->input('storeFilter'));
    $amountBiggerFilter = strip_tags($request->input('amountBiggerFilter'));
    $amountSmallerFilter = strip_tags($request->input('amountSmallerFilter'));
    $whenFromFilter = strip_tags($request->input('whenFromFilter'));
    $whenToFilter = strip_tags($request->input('whenToFilter'));
    $paymentTypeFilter = strip_tags($request->input('paymentTypeFilter'));
    $typeFilter = strip_tags($request->input('typeFilter'));

    $query = DB::table('expenses')->where('user_id', $userId);

    if (!empty($storeFilter)) {
        $query->where('store', $storeFilter);
    }

    if (!empty($amountBiggerFilter)) {
        $query->where('amount', '>', $amountBiggerFilter);
    }

    if (!empty($amountSmallerFilter)) {
        $query->where('amount', '<', $amountSmallerFilter);
    }

    if (!empty($whenFromFilter)) {
        $query->where('when', '>=', $whenFromFilter);
    }

    if (!empty($whenToFilter)) {
        $query->where('when', '<=', $whenToFilter);
    }

    if ($paymentTypeFilter !== 'All') {
        $query->where('paymentType', $paymentTypeFilter);
    }

    if ($typeFilter !== 'All') {
        $query->where('type', $typeFilter);
    }

    return $query->get();
}

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
