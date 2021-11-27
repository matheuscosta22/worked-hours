<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayWorked extends Model
{
    use HasFactory;

    protected $table = 'day_worked';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'started_at',
        'break',
        'return',
        'finished_at',
        'id_user'
    ];

    public function getStartedAtAttribute()
    {
        if ($this->attributes['started_at'] != null) {
            return date('d/m/Y H:i:s', strtotime($this->attributes['started_at']));
        }
        return null;
    }

    public function getBreakAttribute()
    {
        if ($this->attributes['break'] != null) {
            return date('d/m/Y H:i:s', strtotime($this->attributes['break']));
        }
        return null;
    }

    public function getReturnAttribute()
    {
        if ($this->attributes['return'] != null) {
            return date('d/m/Y H:i:s', strtotime($this->attributes['return']));
        }
        return null;
    }

    public function getFinishedAtAttribute()
    {
        if ($this->attributes['finished_at'] != null) {
            return date('d/m/Y H:i:s', strtotime($this->attributes['finished_at']));
        }
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
