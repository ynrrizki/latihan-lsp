<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'std_class_id',
        'nis',
        'nisn',
        'address',
        'phone'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function stdClass(): HasOne
    {
        return $this->hasOne(StdClass::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
