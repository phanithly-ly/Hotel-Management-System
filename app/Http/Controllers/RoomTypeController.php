<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        $sortable = ['id', 'type_name', 'price_per_night', 'capacity'];
        $sort = in_array($request->sort, $sortable) ? $request->sort : 'id';
        $direction = $request->direction === 'desc' ? 'desc' : 'asc';
        $perPage = in_array((int) $request->per_page, [10, 25, 50, 100]) ? (int) $request->per_page : 10;

        $roomTypes = RoomType::withCount('rooms')
            ->when($request->search, fn ($q, $s) => $q->where(fn ($q) => $q
                ->where('type_name', 'like', "%{$s}%")
                ->orWhere('type_name_km', 'like', "%{$s}%")))
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
        RoomType::create($this->withTranslations($this->validated($request)));

        return redirect()->route('room-types.index')->with('success', 'Room type created successfully.');
    }

    public function edit(RoomType $roomType)
    {
        return view('room-types.edit', compact('roomType'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $roomType->update($this->withTranslations($this->validated($request), $roomType));

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
            'type_name_km'    => 'nullable|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'capacity'        => 'required|integer|min:1',
            'description'     => 'nullable|string',
            'description_km'  => 'nullable|string',
        ]);
    }

    // បំពេញវាលខ្មែរ/អង់គ្លេសដោយស្វ័យប្រវត្តិ
    private function withTranslations(array $data, ?RoomType $existing = null): array
    {
        $pairs = ['type_name' => 'type_name_km', 'description' => 'description_km'];

        foreach ($pairs as $enField => $kmField) {
            $text = $data[$enField] ?? null;

            if (blank($text)) {
                $data[$kmField] = null;
                continue;
            }

            // អត្ថបទមិនប្តូរ ហើយមានខ្មែររួចហើយ → រក្សាទុកដូចដើម
            if ($existing && $existing->{$enField} === $text && filled($existing->{$kmField})) {
                continue;
            }

            if (preg_match('/\p{Khmer}/u', $text)) {
                // អ្នកប្រើវាយជាខ្មែរ
                $data[$kmField] = $text;
                $data[$enField] = $this->translateText($text, 'en', 'km') ?? $text;
            } else {
                // អ្នកប្រើវាយជាអង់គ្លេស
                $data[$kmField] = $this->translateText($text, 'km', 'en');
            }
        }

        return $data;
    }

    private function translateText(string $text, string $target, string $source): ?string
    {
        try {
            return GoogleTranslate::trans($text, $target, $source);
        } catch (\Throwable $e) {
            report($e);

            return null;
        }
    }
}