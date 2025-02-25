<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstimateLine extends Model
{
    use HasFactory;

    public function estimate(): BelongsTo
    {
        return $this->belongsTo(Estimate::class);
    }
}
