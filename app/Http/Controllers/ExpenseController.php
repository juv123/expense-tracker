<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
class ExpenseController extends Controller
{
        
    public function create(Request $request){
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'date_of_expense' => 'required|date',
        ]);
        $expense = Expense::create([
            'user_id' => Auth::id(),  // Automatically set the user_id to the logged-in user's ID
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'date_of_expense' => $request->date_of_expense,
        ]);

        return response()->json([
            'message' => 'New Expense created.',
            'data' => $expense
        ], 201);

    }
    public function index(){
        $userId = Auth::id();
        $expenses = Expense::where('user_id', $userId)->get();
        return response()->json($expenses);

    }
    public function update(int $id,Request $request){
        $expense=Expense::findOrFail($id);
        $request->validate([
            'category_id' => 'required|integer',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'date_of_expense' => 'required|date',
        ]);
        $expense->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'date_of_expense' => $request->date_of_expense,
        ]);

        return response()->json([
            'message' => 'Expense updated successfully!',
            'data' => $expense
        ]);
            }
            public function delete(int $id){
                $expense=Expense::findOrFail($id);
                $expense->delete();
                return response()->json(['message' => 'Expense has been removed!']);
            }

    public function summarizeExpenses(Request $request){
        $userId = Auth::id();
        //dd($userId);
        $request->validate([
            'from'=>'required|date',
            'to'=>'required|date|after_or_equal:from',
        ]);
     
        $expense_summary = Expense::select('expenses.category_id', 'expenses_categories.description') 
    ->selectRaw('SUM(expenses.amount) as total_expense')
    ->join('expenses_categories', 'expenses.category_id', '=', 'expenses_categories.id')
    ->where('expenses.user_id', $userId) 
    ->whereBetween('expenses.date_of_expense', [$request->from, $request->to])
    ->groupBy('expenses.category_id', 'expenses_categories.description')
    ->get();
        return response()->json($expense_summary);

    }
}
