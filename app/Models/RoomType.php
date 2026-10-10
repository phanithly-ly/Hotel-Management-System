<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'type_name_km',
        'price_per_night',
        'capacity',
        'description',
        'description_km',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    // បង្ហាញឈ្មោះតាមភាសាបច្ចុប្បន្ន (បើគ្មានភាសាខ្មែរ ប្រើអង់គ្លេសជំនួស)
    public function getDisplayNameAttribute(): string
    {
        return app()->getLocale() === 'km' && $this->type_name_km
            ? $this->type_name_km
            : $this->type_name;
    }

    public function getDisplayDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'km' && $this->description_km
            ? $this->description_km
            : $this->description;
    }
}