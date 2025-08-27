<?php

namespace App\Models;

use App\Models\User;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPrefrence extends Model
{
    use HasFactory;
    protected $table = 'user_prefrences';
    protected $primaryKey = 'prefrence_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'genre_id',
        'preference_weight',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'genre_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
    public function setPreferenceWeightAttribute($value)
    {
        // Validation for weight between 1-10
        if ($value < 1 || $value > 10) {
            throw new \InvalidArgumentException('Preference weight must be between 1 and 10');
        }
        $this->attributes['preference_weight'] = $value;
    }
}
