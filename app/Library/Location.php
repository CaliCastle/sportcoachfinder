<?php

namespace SCF\Library;

class Location
{
    /**
     * Reader instance.
     *
     * @var \GeoIp2\Database\Reader
     */
    private $reader;

    /**
     * IP address.
     *
     * @var string
     */
    public $ip;

    /**
     * Location constructor.
     */
    public function __construct(string $ip = null)
    {
        $this->reader = new \GeoIp2\Database\Reader(database_path('geoip/GeoLite2-City.mmdb'));
        $this->ip = $ip ?? request()->ip();
    }

    public function city()
    {
        return $this->reader->city($this->ip);
    }
}