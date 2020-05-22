<?php 
// Takes in initial php request 

if($_POST['widgets']){
    $totalPackets = calculateWidgets($_POST['widgets']);

    var_dump($totalPackets);
}

// Main function for calculating widgets
function calculateWidgets($widgetsRequired){
    // Array of packets that are avaliable
    //$packets = [500, 250, 1000, 2000, 5000];    
    $packets = array(500, 250, 1000, 2000, 5000);
    $pickedPackets = [];

    $remainder = $widgetsRequired;
    
    $pickedValue = 0;

    sort($packets);

    // Flips the array round to check from biggest to smallest
    $flipPackets = array_reverse($packets);

    while($remainder > 0){

        // Filters out the odd usecase where instead of 500 x1 it says 250 x 2
        if($remainder < $packets[1] && $remainder > 0){

            if($remainder <= $packets[0]){

                array_push($pickedPackets, $packets[0]);
                $remainder = $remainder - $packets[0];

            }else{

                array_push($pickedPackets, $packets[1]);
                $remainder = $remainder - $packets[1];

            }

        // Calculate what packs to send
        }else{
            $highestDeduction = 0;
            foreach($flipPackets as $packet) {
                
                // Calculates the amount of widgets that are remaining to be packed
                $valueLeft = $remainder - $packet;

                if($valueLeft > 0){

                    if($packet >= $highestDeduction){
                        $highestDeduction = $packet;
                        $pickedValue = $packet;
                    }

                }else if($valueLeft === 0){

                    $highestDeduction = $packet;
                    $pickedValue = $packet;

                }else{

                    // Take the smallest value i the array and sets picked value to this so that it doesn't carry the last looped value
                    $pickedValue = $packets[0];

                }
            }
        }

        // Makes sure that if no value is picked that a 0 is not added onto the picked packets array
        if($pickedValue > 0){
             array_push($pickedPackets, $pickedValue);
        }
        
        // Calculates the remaining value left ready for the next loop
        $remainder = $remainder - $pickedValue;

        // Sets picked value back to 0
        $pickedValue = 0;
    }

    return $pickedPackets;
}
?>