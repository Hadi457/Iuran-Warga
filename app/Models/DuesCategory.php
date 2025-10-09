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
    public function members()
    {
        return $this->hasMany(Member::class, 'dues_category_id');
    }
}
