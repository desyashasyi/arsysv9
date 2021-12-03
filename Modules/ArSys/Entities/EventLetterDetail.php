<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventLetterDetail extends Model
{
    use HasFactory;

    protected $fillable = ['time', 'room_id', 'letter_id'];

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\EventLetterDetailFactory::new();
    }
}
