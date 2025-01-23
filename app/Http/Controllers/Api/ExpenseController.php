<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ExpenseController extends Controller
{
        
    public function create(Request $request){
        $userId = Auth::id();
        
        $request->validate([
            'category_id' =>'required|integer',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
            'date_of_expense' => 'required|date',
        ]);
        try{
            
            
            /*if (!$userId) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }*/
            $expense = Expense::create([
                'user_id' =>2,  // Automatically set the user_id to the logged-in user's ID
                'category_id' => $request->category_id,
                'amount' => $request->amount,
                'description' => $request->description,
                'date_of_expense' => $request->date_of_expense,
            ]);
            
        }  catch (\Exception $e) {
            \Log::error('Error creating expense: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }

       

        return response()->json([
            'message' => 'New Expense created.',
            'data' => $expense
        ], 201);

    }
    public function index(){
       // $userId = Auth::id();
       $userId=2;
       $expenses = Expense::with('category') // Assumes a relationship 'category' is defined in Expense model
        ->where('user_id', $userId)
        ->get();
        return response()->json($expenses);

    }
    public function update(int $id,Request $request){
        $expense=Expense::findOrFail($id);
        $request->validate([
            'category_id' => 'required|integer',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
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
            public function getExpensesBetweenDates(Request $request){
                //$userId = auth()->id(); 
                $userId=2;
                $request->validate([
                    'from'=>'required|date',
                    'to'=>'required|date|after_or_equal:from',
                    'category_id'=>'required|integer',
                ]);
                $expenses = Expense::with('category') // Load the related category
                ->where('expenses.user_id', $userId) 
                ->where('expenses.category_id',  [$request->category_id]) 
                ->whereBetween('expenses.date_of_expense', [$request->from, $request->to])
                ->get();
                    
                return response()->json($expenses);
        
            }
    public function summarizeExpenses(Request $request){
        //$userId = Auth::id();
        $userId=2;
        $request->validate([
            'from'=>'required|date',
            'to'=>'required|date|after_or_equal:from',
        ]);
     
        $expense_summary = Expense::select('expenses.category_id', 'expenses_categories.category_name','expenses.date_of_expense') 
    ->selectRaw('SUM(expenses.amount) as total_expense')
    ->join('expenses_categories', 'expenses.category_id', '=', 'expenses_categories.id')
    ->where('expenses.user_id', $userId) 
    ->whereBetween('expenses.date_of_expense', [$request->from, $request->to])
    ->groupBy('expenses.category_id', 'expenses_categories.description')
    ->get();
        return response()->json($expense_summary);

    }
}
