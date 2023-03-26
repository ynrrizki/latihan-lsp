<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StdClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',
        'name',
    ];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }
}
