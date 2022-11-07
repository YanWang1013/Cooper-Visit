<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlaceType
 * @package App
 * @property string google_string
 * @property string display_string
 */
class PlaceType extends Model
{
    protected $table = 't_place_types';
}
