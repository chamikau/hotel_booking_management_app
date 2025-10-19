<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'room_id', 'title', 'name', 'email', 'check_in', 'check_out', 'price'];


    /**
     * @return BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
