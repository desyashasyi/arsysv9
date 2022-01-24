<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleActivityTags extends Model
{
    use HasFactory;

    protected $fillable = ['schedule_id', 'tag_id'];
    protected $table = 'timetable_schedule_activity_tags';

    public function tag() {
        return $this->belongsTo(Tags::class, 'tag_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleActivityTagsFactory::new();
    }
}
