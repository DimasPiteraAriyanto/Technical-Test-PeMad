<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class RefrenceLanguage extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name_language',
    ];

    protected $sortable = [
        'name_language'
    ];
}
