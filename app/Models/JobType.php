<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class JobType extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name_type_job',
    ];

    protected $sortable = [
        'name_type_job',
    ];

    protected $guarded = [
        'id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name_type_job', 'like', '%' . $search . '%');
        });
    }
}
