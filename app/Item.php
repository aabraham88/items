<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Item extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'items';
    protected $fillable = ['sort_order', 'description', 'image_path'];
}
