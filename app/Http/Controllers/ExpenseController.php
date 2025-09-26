    // Show create expense form (web)
    public function create()
    {
        return view('expenses_create');
    }

    // Store new expense (web)
    public function storeWeb(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);
        $validated['user_id'] = auth()->id();
        \App\Models\Expense::create($validated);
        return redirect('/')->with('success', 'Expense added successfully!');
    }

    // Show edit expense form (web)
    public function edit($id)
    {
        $expense = \App\Models\Expense::where('user_id', auth()->id())->findOrFail($id);
        return view('expenses_edit', compact('expense'));
    }

    // Update expense (web)
    public function updateWeb(Request $request, $id)
    {
        $expense = \App\Models\Expense::where('user_id', auth()->id())->findOrFail($id);
        $validated = $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);
        $expense->update($validated);
        return redirect('/')->with('success', 'Expense updated successfully!');
    }

    // Delete expense (web)
    public function delete($id)
    {
        $expense = \App\Models\Expense::where('user_id', auth()->id())->findOrFail($id);
        $expense->delete();
        return redirect('/')->with('success', 'Expense deleted successfully!');
    }
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expense;

class ExpenseController extends Controller
{
    // List expenses with optional filters
    public function index(Request $request)
    {
        $user = auth()->user();
    $query = Expense::where('user_id', $user->id)->with('category');

        // Filtering by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        } elseif ($request->has('filter')) {
            $now = now();
            switch ($request->filter) {
                case 'week':
                    $query->where('date', '>=', $now->copy()->subWeek()->toDateString());
                    break;
                case 'month':
                    $query->where('date', '>=', $now->copy()->subMonth()->toDateString());
                    break;
                case '3months':
                    $query->where('date', '>=', $now->copy()->subMonths(3)->toDateString());
                    break;
            }
        }

    return response()->json($query->orderBy('date', 'desc')->get());
    }

    // Store a new expense
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);
        $validated['user_id'] = auth()->id();
        $expense = Expense::create($validated);
        return response()->json($expense->load('category'), 201);
    }

    // Show a single expense
    public function show($id)
    {
    $expense = Expense::where('user_id', auth()->id())->with('category')->findOrFail($id);
    return response()->json($expense);
    }

    // Update an expense
    public function update(Request $request, $id)
    {
        $expense = Expense::where('user_id', auth()->id())->findOrFail($id);
        $validated = $request->validate([
            'amount' => 'sometimes|numeric',
            'description' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'date' => 'sometimes|date',
        ]);
        $expense->update($validated);
        return response()->json($expense->load('category'));
    }

    // Delete an expense
    public function destroy($id)
    {
        $expense = Expense::where('user_id', auth()->id())->findOrFail($id);
        $expense->delete();
        return response()->json(['message' => 'Expense deleted']);
    }
}
