<?php

namespace BladeParser;

class Position {
    private $lat;
    private $lng;
    private $altitude;

    public function __construct($data) {
        $this->lat = $data['lat'];
        $this->lng = $data['lng'];
        $this->altitude = $data['altitude'];
    }

    public function __get($property) {
        switch($property) {
            case 'lat':
            case 'lng':
            case 'altitude':
                return $this->$property;
                break;
        }
    }

    public function getPositionAsArray() {
        return array(
            'lat' => $this->lat,
            'lng' => $this->lng,
            'altitude' => $this->altitude
        );
    }

    public function __toString() {
        if($this->altitude) {
            return $this->lat . ", " . $this->lng . " @ " . $this->altitude . "m";
        } else {
            return $this->lat . ", " . $this->lng;
        }
    }
}
