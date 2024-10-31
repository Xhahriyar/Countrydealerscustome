<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOfficer extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function deals()
    {
        return $this->hasMany(PlotSalesOfficer::class, 'sales_officer_id');
    }

}
