<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Florist;
use App\Http\Requests\StoreFloristRequest;
use App\Http\Requests\UpdateFloristRequest;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFloristController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Florist::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('is_active') && $request->is_active !== '') {
            $query->where('is_active', $request->is_active);
        }

        $florists = $query->paginate(15);

        return view('admin.florists.index', compact('florists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.florists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFloristRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::optimizeAndStore($request->file('image'), 'florists');
        }

        Florist::create($data);

        return redirect()->route('admin.florists.index')->with('success', 'Florist created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Florist $florist)
    {
        return view('admin.florists.show', compact('florist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Florist $florist)
    {
        return view('admin.florists.edit', compact('florist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFloristRequest $request, Florist $florist)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($florist->image && Storage::disk('public')->exists($florist->image)) {
                Storage::disk('public')->delete($florist->image);
            }
            $data['image'] = ImageHelper::optimizeAndStore($request->file('image'), 'florists');
        }

        $florist->update($data);

        return redirect()->route('admin.florists.index')->with('success', 'Florist updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Florist $florist)
    {
        // Delete image
        if ($florist->image && Storage::disk('public')->exists($florist->image)) {
            Storage::disk('public')->delete($florist->image);
        }

        $florist->delete();

        return redirect()->route('admin.florists.index')->with('success', 'Florist deleted successfully.');
    }

    /**
     * Export florists to CSV.
     */
    public function export()
    {
        $florists = Florist::all();

        $filename = 'florists_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($florists) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, ['ID', 'Name', 'Description', 'Address', 'Phone', 'Email', 'Is Active', 'Created At']);

            // Data rows
            foreach ($florists as $florist) {
                fputcsv($file, [
                    $florist->id,
                    $florist->name,
                    $florist->description,
                    $florist->address,
                    $florist->phone,
                    $florist->email,
                    $florist->is_active ? 'Yes' : 'No',
                    $florist->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
