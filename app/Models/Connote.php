<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;


class Connote extends Model
{
    protected $connection = 'mongodb';
	protected $collection = 'connotes';

    use HasFactory;

    protected $fillable = [
        "connote_service",
        "connote_service_price",
        "connote_amount",
        "connote_code",
        "location_name",
        "location_id"
    ];
}
