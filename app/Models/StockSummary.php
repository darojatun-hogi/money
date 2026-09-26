<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;

class StockSummary extends Model
{
    protected $connection = 'mysql';

    public function stock_indicator(): hasOne
    {
        return $this->hasOne(StockIndicator::class);
    }
}
