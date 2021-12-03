<?php

namespace Modules\Office\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LetterType extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'office_letter_type';

    protected static function newFactory()
    {
        return \Modules\Office\Database\factories\LetterTypeFactory::new();
    }
}
