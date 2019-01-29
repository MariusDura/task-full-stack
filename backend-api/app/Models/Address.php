<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street', 'suite', 'city', 'zipcode', 'geo_lat', 'geo_lng'
    ];

    /**
     * Geo attribute for structured address data return.
     *
     */
    protected $appends = ['geo'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'geo_lat', 'geo_lng',
    ];

    public function getGeoAttribute()
    {
        return ['lat' => $this->geo_lat, 'lng' => $this->geo_lng];
    }
}