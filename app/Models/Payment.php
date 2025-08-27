<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    protected $casts = [
        'due_date' => 'date', // atau 'datetime'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function duesCategory()
    {
        return $this->belongsTo(DuesCategory::class, 'dues_category_id');
    }
    public function officer()
    {
        return $this->belongsTo(Officer::class, 'officer_id');
    }
}
