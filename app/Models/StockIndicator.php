<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockIndicator extends Model
{
    protected $connection = 'mysql';
    protected $casts = [
        'signal_tags' => 'array'
    ];

    public function stock_summary(): BelongsTo
    {
        return $this->belongsTo(StockSummary::class);
    }
}
