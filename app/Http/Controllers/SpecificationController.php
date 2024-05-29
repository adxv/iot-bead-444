<?php
namespace App\Http\Controllers;

use App\Models\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sortableColumns = ['id', 'name', 'description'];
        $sortBy = $request->get('sort_by', 'id'); // Default sorting by 'id'
        $sortOrder = $request->get('sort_order', 'asc'); // Default order is 'asc'

        if (!in_array($sortBy, $sortableColumns)) {
            $sortBy = 'id'; // Fallback to 'id' if the column is not sortable
        }

        $specifications = Specification::orderBy($sortBy, $sortOrder)->get();

        return view('specifications.index', compact('specifications', 'sortBy', 'sortOrder'));
    }
    

    public function create()
    {
        return view('specifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        Specification::create($request->only(['name', 'description']));
    
        return redirect()->route('specifications.index')
                         ->with('success', 'Specification created successfully.');
    }
    

    public function show(Specification $specification)
    {
        return view('specifications.show', compact('specification'));
    }

    public function edit(Specification $specification)
    {
        return view('specifications.edit', compact('specification'));
    }

    public function update(Request $request, Specification $specification)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $specification->update($request->only(['name', 'description']));

        return redirect()->route('specifications.index')
                         ->with('success', 'Specification updated successfully.');
    }

    public function destroy(Specification $specification)
    {
        $specification->delete();

        return redirect()->route('specifications.index')
                         ->with('success', 'Specification deleted successfully.');
    }
}

