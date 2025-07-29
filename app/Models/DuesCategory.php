<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuesCategory extends Model
{
    protected $guarded = [];
    public function duesMembers()
    {
        return $this->hasMany(DuesMember::class, 'idduescategory');
    }
}
