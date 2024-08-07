<?php

namespace App\Models;

use App\ModelFilters\SubDepartmentFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($subDepartment) {
            $maxOrder = SubDepartment::max('order');
            $subDepartment->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function modelFilter()
    {
        return $this->provideFilter(SubDepartmentFilter::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}