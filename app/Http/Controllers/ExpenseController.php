<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('pages.expense.index', [
            'expenses' => $expenses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.expense.create');
    }

    /**
     * Store new or Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $id = is_numeric($request->id)? $request->id : null;

        $data = $request->validate([
            'date' => 'required|date',
            'description' => 'required',
            'category' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Prepare the data to be used for updating or creating the expense
        $expenseData = [
            'date' => $data['date'],
            'description' => $data['description'],
            'category' => $data['category'],
            'amount' => $data['amount'],
        ];

//         Use updateOrcreate to either update an existing expense or create a new one
        Expense::updateOrcreate(
            ['id' => $id], // Condition to find the expense by ID
            $expenseData // Data for updating or creating the expense
        );

        $message = $id ? 'Expense updated successfully' : 'Expense created successfully';

        return redirect()->route('expenses.index')->with('success', $message);
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
        $expense = Expense::findOrfail($id);
//        dd($expense);
        return view('pages.expense.create', [
            'expense' => $expense
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the expense by its ID
        $expense = Expense::find($id);

        if (!$expense) {
            return redirect()->route('expenses.index')->with('error', 'Expense not found.');
        }

        // Soft delete the expense
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted (soft delete) successfully.');
    }
}
