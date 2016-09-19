<?php

namespace BladeParser;

class Activity {
    private $parser;

    public function __construct($filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        switch($extension) {
            case 'tcx':
                include_once('src/TCXParser.class.php');
                $this->parser = new TCXParser($filename);
                break;
            default:
                throw new \Exception("Unsupported file type: $extension.");
        }
    }

    public function __get($property) {
        switch($property) {
            case 'sport':
            case 'startTime':
            case 'distance':
            case 'calories':
            case 'intensity':
            case 'triggerMethod':
            case 'trackPoints':
                return $this->parser->$property;
                break;
            case 'trackPointsCount':
                return count($this->parser->trackPoints);
                break;
        }
    }
}    
