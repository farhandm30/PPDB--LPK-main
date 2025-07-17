<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'photo',
        'rating',
        'content',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
    ];

    /**
     * Get the active testimonials ordered by specified order
     */
    public static function getActiveTestimonials()
    {
        return self::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}