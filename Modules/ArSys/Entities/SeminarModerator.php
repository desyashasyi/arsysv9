<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarModerator extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'moderator_id'];
    protected $table = 'arsys_seminar_room_moderator';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'moderator_id', 'id');
    }
    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\SeminarModeratorFactory::new();
    }
}
