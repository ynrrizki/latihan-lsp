<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spp extends Model
{
    use HasFactory;
    // protected $dates = ['year'];
    // protected $casts = [
    //     'year' => 'datetime:Y',
    // ];
    protected $fillable = ['year', 'amount'];

    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
