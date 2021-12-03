<?php

namespace Modules\CollabRe\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ArSys\Entities\Student;

class CollabreMember extends Model
{
    use HasFactory;

    protected $fillable = ['collabre_id', 'student_id', 'status'];
    protected $table = 'collabre_member';

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\CollabRe\Database\factories\CollabreMembersFactory::new();
    }
}
