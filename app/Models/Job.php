<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'requirements',
        'location',
        'type',
        'level',
        'salary_min',
        'salary_max',
        'salary_negotiable',
        'benefits',
        'application_deadline',
        'status',
        'user_id',
        'category_id',
    ];

protected $casts = [
    'benefits' => 'array',
    'application_deadline' => 'date',
    'salary_min' => 'float',
    'salary_max' => 'float',
    'salary_negotiable' => 'boolean',
];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            $job->slug = Str::slug($job->title . '-' . Str::random(5));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getFormattedSalaryAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return 'Rp ' . number_format($this->salary_min, 0, ',', '.') . ' - Rp ' . number_format($this->salary_max, 0, ',', '.');
        }

        if ($this->salary_min && !$this->salary_max) {
            return 'Rp ' . number_format($this->salary_min, 0, ',', '.') . ' (min)';
        }

        if (!$this->salary_min && $this->salary_max) {
            return 'Rp ' . number_format($this->salary_max, 0, ',', '.') . ' (max)';
        }

        return $this->salary_negotiable ? 'Negosiasi' : 'Tidak tersedia';
    }
}
