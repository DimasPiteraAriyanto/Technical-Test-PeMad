<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ServiceOffering extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'job_id',
        'company_id',
        'price_service_offerings',
        'detail_service_offerings',
    ];

    protected $sortable = [
        'company_id',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(RefrenceCompany::class, 'company_id', 'id');
    }

}
