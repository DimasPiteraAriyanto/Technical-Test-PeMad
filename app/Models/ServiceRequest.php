<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ServiceRequest extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'job_id',
        'company_id',
        'name_service_request',
        'start_date_service_request',
        'end_date_service_request',
        'price_service_request',
        'detail_service_request',
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
