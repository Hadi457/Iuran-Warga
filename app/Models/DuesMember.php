<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuesMember extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
    public function duesCategory()
    {
        return $this->belongsTo(DuesCategory::class, 'dues_category_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'iduser', 'id');
    }
}
