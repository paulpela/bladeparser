<?php

namespace BladeParser;

include_once('src/Parser.class.php');

class TCXParser extends Parser {
    private $xmldata;
    private $trackpoints = array();

    public function __construct($filename) {
        $this->xmldata = \simplexml_load_file($filename);
    }

    public function __get($property) {
        switch($property) {
            case 'sport':
                return $this->xmldata->Activities->Activity['Sport'];
                break;
            case 'startTime':
                return $this->xmldata->Activities->Activity->Lap['StartTime'];
                break;
            case 'distance':
                return $this->xmldata->Activities->Activity->Lap->DistanceMeters;
                break;
            case 'calories':
                return $this->xmldata->Activities->Activity->Lap->Calories;
                break;
            case 'intensity':
                return $this->xmldata->Activities->Activity->Lap->Intensity;
                break;
            case 'triggerMethod':
                return $this->xmldata->Activities->Activity->Lap->TriggerMethod;
                break;
            case 'trackPoints':
                if(!$this->trackpoints) {
                    $this->prepareTrackPoints();
                }
                return $this->trackpoints;
                break;

        }
    }

    private function prepareTrackPoints() {
        foreach($this->xmldata->Activities->Activity->Lap->Track->Trackpoint as $trackpoint) {
            $data = array();

            $data['time'] = $trackpoint->Time;
            $data['lat'] = $trackpoint->Position->LatitudeDegrees;
            $data['lng'] = $trackpoint->Position->LongitudeDegrees;
            $data['altitude'] = $trackpoint->AltitudeMeters;

            include_once('src/TrackPoint.class.php');
            $this->trackpoints[] = new TrackPoint($data);
        }
    }
}
