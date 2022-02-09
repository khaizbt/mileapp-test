<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;


class KoliData extends Model
{
    protected $connection = 'mongodb';
	protected $collection = 'koli_data';
    use HasFactory;
}
