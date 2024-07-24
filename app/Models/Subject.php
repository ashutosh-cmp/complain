<?php

namespace App\Models;

use App\ModelFilters\SubjectFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    // Automatically set the 'order' field when adding
    public static function boot()
    {
        parent::boot();

        static::creating(function ($subject) {
            // Set 'order' to the next available number
            $maxOrder = Subject::max('order');
            $subject->order = $maxOrder ? $maxOrder + 1 : 1;
        });
    }

    public function modelFilter()
    {
        return $this->provideFilter(SubjectFilter::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
