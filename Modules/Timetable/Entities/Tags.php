<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_tags';
    
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\TagsFactory::new();
    }
}
