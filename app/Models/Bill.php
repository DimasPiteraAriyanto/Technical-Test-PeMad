<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Bill extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'project_id',
        'service_request_id',
        'service_offering_id',
        'total_price',
        'status_bill',
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id', 'id');
    }

    public function serviceOffering()
    {
        return $this->belongsTo(ServiceOffering::class, 'service_offering_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
