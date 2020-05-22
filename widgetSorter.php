<?php 
// Takes in initial php request 

if($_POST['widgets']){
    $totalPackets = calculateWidgets($_POST['widgets']);

    echo json_encode($totalPackets);
}

// Main function for calculating widgets
function calculateWidgets($widgetsRequired){
    // Array of packets that are avaliable
    $packets = array(250, 500, 1000, 2000, 5000);

    // Sorts array into numerical order just incase a user changes them to not be 
    sort($packets);

    // Final array for storing the finished order
    $pickedPackets = [];

    // Sets remainder to the final widgets required
    $remainder = $widgetsRequired;
    
    $pickedValue = 0;

    // Flips the array round to check from biggest to smallest
    $flipPackets = array_reverse($packets);

    // Keeps running until remainder is less than 0
    while($remainder > 0){

        // Filters out the odd usecase where instead of 500 x1 it says 250 x 2
        if($remainder < $packets[1] && $remainder > 0){

            // If remainder is less than or equal to the smallest value in packets
            if($remainder <= $packets[0]){

                array_push($pickedPackets, $packets[0]);
                $remainder = $remainder - $packets[0];
            
            // Otherwise value is bigger than 250 so needs to be 500 or second biggest total
            }else{

                array_push($pickedPackets, $packets[1]);
                $remainder = $remainder - $packets[1];

            }

        // Runs when the value remaining is more than the second value (500) 
        }else{
            // Sets a variable to hold the highest possible deduction 
            $highestDeduction = 0;

            // Runs through each of the packets sizes
            foreach($flipPackets as $packet) {
                
                // Calculates the amount of widgets that are remaining to be packed for this particular size
                $valueLeft = $remainder - $packet;

                // If the value calculated is above 0 
                if($valueLeft > 0){ 

                    // If the packet value is deducting more than the highest value currently saved then replace this value
                    if($packet >= $highestDeduction){
                        $highestDeduction = $packet;
                        $pickedValue = $packet;
                    }
                
                // Else if the value left completely matches 0
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