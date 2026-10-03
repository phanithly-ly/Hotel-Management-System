<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
        public function index(Request $request)
    {
        $sortable = ['id', 'room_number', 'floor', 'status'];
        $sort = in_array($request->sort, $sortable) ? $request->sort : 'id';
        $direction = $request->direction === 'desc' ? 'desc' : 'asc';
        $perPage = in_array((int) $request->per_page, [10, 25, 50, 100]) ? (int) $request->per_page : 10;

        $rooms = Room::with('roomType')
            ->when($request->search, function ($q, $s) {
                $q->where(function ($q) use ($s) {
                    $q->where('room_number', 'like', "%{$s}%")
                    ->orWhereHas('roomType', fn ($t) => $t->where('type_name', 'like', "%{$s}%"));
                });
            })
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->room_type_id, fn ($q, $id) => $q->where('room_type_id', $id))
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        $roomTypes = RoomType::orderBy('type_name')->get();

        return view('rooms.index', compact('rooms', 'roomTypes', 'sort', 'direction', 'perPage'));
    }

    public function create()
    {
        $roomTypes = RoomType::orderBy('type_name')->get();

        return view('rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        Room::create($this->validated($request));

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::orderBy('type_name')->get();

        return view('rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $room->update($this->validated($request, $room));

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }

    private function validated(Request $request, ?Room $room = null): array
    {
        return $request->validate([
            'room_number'  => ['required', 'string', 'max:255', Rule::unique('rooms', 'room_number')->ignore($room?->id)],
            'room_type_id' => 'required|exists:room_types,id',
            'floor'        => 'nullable|integer|min:0',
            'status'       => 'required|in:available,occupied,maintenance',
            'description'  => 'nullable|string',
        ]);
    }
}