<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $fillable = [
        'production_date',
        'product_line',
        'produced_quantity',
        'defect_quantity',
    ];

    protected $casts = [
        'production_date' => 'date',
    ];

    public function getEfficiencyAttribute()
    {
        if ($this->produced_quantity == 0) {
            return 0;
        }

        return round(
            (($this->produced_quantity - $this->defect_quantity) / $this->produced_quantity) * 100,
            2
        );
    }
}