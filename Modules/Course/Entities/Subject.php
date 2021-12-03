<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'credit', 'type_id',
                'program_id', 'specialization_id', 'curriculum_id'];

    protected $table = 'timetable_subject';

    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function program() {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }
    public function type() {
        return $this->belongsTo(SubjectType::class, 'type_id', 'id');
    }
    public function year() {
        return $this->belongsTo(SubjectYear::class, 'year_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\SubjectFactory::new();
    }
}
