<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;

class DashboardController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType')->orderBy('floor')->orderBy('room_number')->get();

        $total       = $rooms->count();
        $available   = $rooms->where('status', 'available')->count();
        $occupied    = $rooms->where('status', 'occupied')->count();
        $maintenance = $rooms->where('status', 'maintenance')->count();
        $occupancyRate = $total ? (int) round($occupied / $total * 100) : 0;

        $estRevenue = $rooms->where('status', 'occupied')
            ->sum(fn ($r) => $r->roomType->price_per_night ?? 0);
        $maxRevenue = $rooms->where('status', '!=', 'maintenance')
            ->sum(fn ($r) => $r->roomType->price_per_night ?? 0);

        $floors = $rooms->groupBy(fn ($r) => $r->floor ?? 0)->sortKeysDesc();
        $maintenanceRooms = $rooms->where('status', 'maintenance');

        $roomTypes = RoomType::withCount([
            'rooms',
            'rooms as available_count' => fn ($q) => $q->where('status', 'available'),
        ])->orderBy('price_per_night')->get();

        return view('dashboard', compact(
            'total', 'available', 'occupied', 'maintenance', 'occupancyRate',
            'estRevenue', 'maxRevenue', 'floors', 'maintenanceRooms', 'roomTypes'
        ));
    }
}