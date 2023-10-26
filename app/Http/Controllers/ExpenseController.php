<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\File;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = str_contains($request->route()->uri(), 'expense') ? Expense::TYPE_EXPENSE : Expense::TYPE_INCOME;
        $expenses = Expense::where('type', $type)->get();
        return view('pages.expense.index', [
            'expenses' => $expenses,
            'type' => $type
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(Request $request)
    {
        $type = str_contains($request->route()->uri(), 'expense') ? Expense::TYPE_EXPENSE : Expense::TYPE_INCOME;
        return view('pages.expense.create', [
            'type' => $type
        ]);
    }

    /**
     * Store new or Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $id = is_numeric($request->id) ? $request->id : null;

        $data = $request->validate([
            'date' => 'required|date',
            'type' => 'required',
            'description' => 'required',
            'category' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Prepare the data to be used for updating or creating the expense
        $expenseData = [
            'date' => $data['date'],
            'type' => $data['type'],
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
    public function edit(Request $request, string $id)
    {
        $type = str_contains($request->route()->uri(), 'expense') ? Expense::TYPE_EXPENSE : Expense::TYPE_INCOME;
        $expense = Expense::findOrfail($id);
        $expense_files = File::where('model_related_to', 'expense')->where('model_id', $id)->get();

        return view('pages.expense.create', [
            'expense' => $expense,
            'files' => $expense_files,
            'type' => $type
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
