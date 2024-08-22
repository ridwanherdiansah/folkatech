<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'company_id',
        'email',
        'phone',
    ];
    
    public $timestamps = true;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $dates = ['deleted_at'];
}   
