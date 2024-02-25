<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookRoom extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'book_rooms';

    public $timestamps = true;

    protected $guarded = [];

}
