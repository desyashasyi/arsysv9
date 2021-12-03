<?php

namespace Modules\CollabRe\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collabre extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'founder_id', 'description'];
    protected $table = 'collabre';

    protected static function newFactory()
    {
        return \Modules\CollabRe\Database\factories\PageFactory::new();
    }
}
