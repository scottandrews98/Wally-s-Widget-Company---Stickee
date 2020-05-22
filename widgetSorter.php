<?php 
// Takes in initial php request 

if($_POST['widgets']){
    $totalPackets = calculateWidgets($_POST['widgets']);

    echo $totalPackets;
}

// Array of packets that are avaliable
$packets = [250, 500, 1000, 2000, 5000];

// Main function for calculating widgets
function calculateWidgets($widgetsRequired){

    foreach($packets as $packet) {
        echo $packet;
    }

    return $widgetsRequired;
}

?>