<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Project extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'job_id',
        'name_project',
        'start_date_project',
        'end_date_project',
        'price_project',
        'detail_project',
    ];

    protected $sortable = [
        'name_project',
        'start_date_project',
        'end_date_project',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

}
