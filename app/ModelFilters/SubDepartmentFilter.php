<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class SubDepartmentFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function name($name)
    {
        return $this->whereLike('name', $name);
    }

    public function department($department)
    {
        return $this->where('department_id', $department);
    }

    public function user($user)
    {
        return $this->where('created_by', $user);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }
}