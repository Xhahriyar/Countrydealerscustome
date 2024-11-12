<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOfficeEMployee extends Model
{
    protected $table = "admin_office_employees";
    protected $guarded = [];
    use HasFactory;

    public function histories()
    {
        return $this->hasMany(History::class , 'employee_id' , 'id');
    }
}
