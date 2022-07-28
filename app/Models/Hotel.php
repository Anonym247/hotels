<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use Filterable;

    /**
     * @var bool
     */
    public $timestamps = false;
}
