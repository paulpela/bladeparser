<?php

namespace BladeParser;

class TrackPoint {
    private $time;
    private $position;
    private $heartRate;

    public function __construct($data) {
        if(is_int($data['time'])) {
            $this->time = $data['time'];
        } else {
            // TODO parse string date
            $this->time = $data['time']; // temporary
        }

        include_once('src/Position.class.php');
        $this->position = new Position($data);

        if(isset($data['heartRate'])) {
            $this->heartRate = $data['heartRate'];
        } else {
            $this->heartRate = -1;
        }
    }

    public function __get($property) {
        switch($property) {
            case 'time':
            case 'position':
            case 'heartRate':
                return $this->$property;
                break;
            case 'lat':
            case 'latitude':
            case 'lng':
            case 'longitude':
            case 'altitude':
            case 'alt':
                return $this->position->$property;
                break;
        }
    }

    public function __toString() {
        return $this->time . ": " . $this->position . " HR: " . $this->heartRate;
    }
}
