<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class RefrenceCompany extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name_company',
        'email_company',
        'account_bank_company',
        'phone_company',
    ];

    protected $sortable = [
      'name_company',
      'email_company'
    ];


}
