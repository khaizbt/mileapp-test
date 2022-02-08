<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Package extends Model
{
    protected $connection = 'mongodb';
	protected $collection = 'packages';

    protected $fillable = [
        "customer_name",
        "customer_code",
        "transaction_amount",
        "transaction_state",
        "transaction_code",
        "location_id",
        "customer_attribute",
        "connote",
        "origin_data",
        "destination_data",
        "koli_data",
        "custom_field",
        "currentLocation"
    ];
}
