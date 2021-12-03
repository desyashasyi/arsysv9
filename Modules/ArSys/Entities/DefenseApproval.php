<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefenseApproval extends Model
{
    use HasFactory;

    protected $fillable = ['defense_model', 'approver_id', 'approver_role', 'research_id'];
    protected $table = 'arsys_defense_approval';

    public function defenseModel(){
        return $this->belongsTo(DefenseModel::class, 'defense_model', 'id');
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'approver_id','id' );
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\DefenseApprovalFactory::new();
    }
}
