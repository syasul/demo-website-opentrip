<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'user_id',
    'trip_id',
    'jumlah_peserta',
    'status_pembayaran',
    'total_harga',
    'notes'
])]
class Booking extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'total_harga' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function participants()
    {
        return $this->hasMany(BookingParticipant::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
