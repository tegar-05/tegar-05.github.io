<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Slider::query();

        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('is_active') && $request->is_active !== '') {
            $query->where('is_active', $request->is_active);
        }

        $sliders = $query->orderBy('order')->paginate(15);

        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::optimizeAndStore($request->file('image'), 'sliders');
        }

        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = ImageHelper::optimizeAndStore($request->file('image'), 'sliders');
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // Delete image
        if ($slider->image && file_exists(public_path('storage/' . $slider->image))) {
            unlink(public_path('storage/' . $slider->image));
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }

    /**
     * Update slider order.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:sliders,id',
        ]);

        foreach ($request->order as $index => $id) {
            Slider::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Order updated successfully.']);
    }

    /**
     * Export sliders to CSV.
     */
    public function export()
    {
        $sliders = Slider::all();

        $filename = 'sliders_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($sliders) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, ['ID', 'Title', 'Subtitle', 'Link', 'Order', 'Is Active', 'Created At']);

            // Data rows
            foreach ($sliders as $slider) {
                fputcsv($file, [
                    $slider->id,
                    $slider->title,
                    $slider->subtitle,
                    $slider->link,
                    $slider->order,
                    $slider->is_active ? 'Yes' : 'No',
                    $slider->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
