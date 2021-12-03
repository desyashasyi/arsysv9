<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'arsys_document_type';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\DocumentTypeFactory::new();
    }
}
