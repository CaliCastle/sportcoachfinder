<?php

namespace SCF\Models;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Generate default data.
     */
    public static function generateDefaults()
    {
        foreach (self::defaultData() as $sport) {
            static::create([
                'name' => $sport
            ]);
        }
    }

    /**
     * Default sport data set.
     *
     * @return array
     */
    public static function defaultData()
    {
        return [
            'Badminton', 'Baseball', 'Basketball', 'Bowling',
            'Cheerleading', 'Climbing', 'Cricket', 'Cycling',
            'Canoeing', 'Dance', 'Fencing', 'Football', 'Golf',
            'Gymnastics', 'Hockey', 'Horse Riding', 'Ice Hockey',
            'Kayaking', 'Lacrosse', 'Marathon', 'Martial Arts',
            'Mental Coaching', 'Netball', 'Personal Training', 'Pilates',
            'Racquetball', 'Rowing', 'Rugby', 'Skating', 'Skiing',
            'Snowboarding', 'Soccer', 'Softball', 'Surfing', 'Swimming',
            'Table Tennis', 'Tennis', 'Track and Field', 'Triathlon',
            'Volleyball', 'Water Polo', 'Yoga', 'Disabled Sports'
        ];
    }
}
