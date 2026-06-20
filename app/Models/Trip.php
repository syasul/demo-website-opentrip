<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nama_gunung',
    'slug',
    'deskripsi',
    'itinerary',
    'harga',
    'kuota',
    'sisa_kuota',
    'level_kesulitan',
    'tanggal_berangkat',
    'tanggal_pulang',
    'status',
    'image_url',
    'location',
    'what_is_included'
])]
class Trip extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'itinerary' => 'array',
            'what_is_included' => 'array',
            'tanggal_berangkat' => 'date',
            'tanggal_pulang' => 'date',
            'harga' => 'decimal:2',
        ];
    }

    public function images()
    {
        return $this->hasMany(TripImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
