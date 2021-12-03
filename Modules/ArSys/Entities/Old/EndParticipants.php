<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EndParticipants extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'endproject_defense_participants';

    public function examiner(){
        return $this->hasMany(EndExaminer::class, 'defense_id', 'defense_id')->where('defense_type', 'Pre-defense');
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\Old/EndParticipantsFactory::new();
    }
}
