<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rooms';

    public $timestamps = true;

    protected $guarded = [];

    const TYPE_SINGLE = 1;
    const TYPE_COUPLE = 2;
    const TYPE_LUXURY = 3;

    const STATUS_OPEN = 1;
    const STATUS_MAINTAIN = 2;

    public function bookRooms()
    {
        return $this->hasMany(BookRoom::class, 'room_id');
    }
}
