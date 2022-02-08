<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;


class Location extends Model
{
    protected $connection = 'mongodb';
	protected $collection = 'locations';
    use HasFactory;

    protected $fillable = [
        "code",
        "name",
        "type"
    ];
}
