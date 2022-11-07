<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Place
 * @package App
 * @property integer type_id
 * @property string name
 * @property string address
 * @property double latitude
 * @property double longitude
 * @property string website
 * @property string image
 */
class Place extends Model
{
    protected $table = 't_places';

    protected $fillable = ['type_id', 'name', 'address', 'latitude', 'longitude', 'website', 'image'];

    /**
     * @param string $name
     * @return Place
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $address
     * @return Place
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param float $latitude
     * @return Place
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @param float $longitude
     * @return Place
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @param string $website
     * @return Place
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @param string $image
     * @return Place
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @param int $type_id
     * @return Place
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;
        return $this;
    }
}
