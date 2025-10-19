<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'description', 'price', 'guests', 'image'];



    /**
     * A room can have many bookings
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'room_id');
    }
}
