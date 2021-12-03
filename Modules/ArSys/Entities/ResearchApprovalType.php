<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchApprovalType extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $table = 'arsys_event_type';

}
