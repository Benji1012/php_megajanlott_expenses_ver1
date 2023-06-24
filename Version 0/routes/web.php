<?php


use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Livewire\ExpensesTableView;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\ExpenseController;
use App\Http\Livewire\FilteredExpensesDiagram;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    $expenses = [];
    if(auth()->check()){
        $expenses = auth()->user()->usersExpenses()->latest()->get();
    }

   // $posts = Post::where('user_id', auth()->id())->get();
    return view('home', ['expenses' => $expenses]);
});*/

Route::get('/', function () {
    $expenses = [];
    if (auth()->check()) {
        $userId = auth()->id();
        $expenses = DB::table('expenses')->where('user_id', $userId)->get();
    }

    return view('home', ['expenses' => $expenses]);
});



Route::post('/register', [UserController::class, 'register']);
Route::post('/logout',[UserController::class, 'logout']);
Route::post('/login',[UserController::class, 'login']);

//Expenses related routes
Route::post('/create-expense', [ExpenseController::class, 'createExpense']);
Route::get('/edit-expense/{expense}', [ExpenseController::class, 'showEditScreen']);
Route::put('/edit-expense/{expense}', [ExpenseController::class, 'updateExpense']);
Route::delete('/delete-expense/{expense}', [ExpenseController::class, 'deleteExpense']);

//Filter, Diagram and Print
Route::get('/filter-expense', [ExpenseController::class, 'filterExpense']);
Route::get('/filter-expense-diagram', [ExpenseController::class, 'filterExpenseDiagram']);
Route::get('/create-pdf', [ExpenseController::class, 'createPdf']);