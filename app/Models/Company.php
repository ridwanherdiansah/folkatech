<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    public $timestamps = true;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
