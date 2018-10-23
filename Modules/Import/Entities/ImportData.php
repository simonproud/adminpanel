<?php

namespace Modules\Import\Entities;

use Illuminate\Database\Eloquent\Model;

class ImportData extends Model
{
    protected $table = 'import_data';
    protected $fillable = ['main_filename', 'original_filename', 'import_header', 'imported', 'import_data'];
}
