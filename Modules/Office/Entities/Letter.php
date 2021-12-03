<?php

namespace Modules\Office\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = ['to', 'program_id', 'subyek', 'number', 'date','type_id'];
    protected $table = 'office_letter';

    public function type(){
        return $this->belongsTo(LetterType::class, 'type_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\Office\Database\factories\LetterFactory::new();
    }
}
