<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventLetterType extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'arsys_event_letter_type';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\EventLetterTypeFactory::new();
    }
}
