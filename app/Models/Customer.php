<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;


class Customer extends Model
{
    protected $connection = 'mongodb';
	protected $collection = 'customers';

    use HasFactory;

    protected $fillable = [
        "customer_name",
        "customer_address",
        "customer_email",
        "customer_phone",
        "customer_address_detail",
        "customer_zip_code",
        "zone_code",
        "organization_id",
        "location_id"
    ];
}
