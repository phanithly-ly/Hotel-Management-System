<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
            public function index(Request $request)
        {
            $sortable = ['id', 'type_name', 'price_per_night', 'capacity'];
            $sort = in_array($request->sort, $sortable) ? $request->sort : 'id';
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $perPage = in_array((int) $request->per_page, [10, 25, 50, 100]) ? (int) $request->per_page : 10;

            $roomTypes = RoomType::withCount('rooms')
                ->when($request->search, fn ($q, $s) => $q->where('type_name', 'like', "%{$s}%"))
                ->when($request->capacity, fn ($q, $c) => $q->where('capacity', $c))
                ->orderBy($sort, $direction)
                ->paginate($perPage)
                ->withQueryString();

            return view('room-types.index', compact('roomTypes', 'sort', 'direction', 'perPage'));
        }

    public function create()
    {
        return view('room-types.create');
    }

    public function store(Request $request)
    {
        RoomType::create($this->validated($request));

        return redirect()->route('room-types.index')->with('success', 'Room type created successfully.');
    }

    public function edit(RoomType $roomType)
    {
        return view('room-types.edit', compact('roomType'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $roomType->update($this->validated($request));

        return redirect()->route('room-types.index')->with('success', 'Room type updated successfully.');
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();

        return redirect()->route('room-types.index')->with('success', 'Room type deleted successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'type_name'       => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'capacity'        => 'required|integer|min:1',
            'description'     => 'nullable|string',
        ]);
    }
}