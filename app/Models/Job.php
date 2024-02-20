<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Job extends Model
{
    use HasFactory;

    use HasFactory, Sortable;

    protected $fillable = [
        'name_job',
        'job_type_id',
    ];

    protected $sortable = [
        'name_job',
    ];

    protected $guarded = [
        'id',
    ];

    public function jobTypes()
    {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }
}
