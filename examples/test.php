<?php

include_once('Activity.class.php');

$activity = new BladeParser\Activity('examples/testdata.tcx');

echo $activity->sport . "\n";
echo $activity->trackPoints[0] . "\n";
echo $activity->trackPoints[10] . "\n";
echo count($activity->trackPoints) . "\n";
