<?php
    function verifyArrayNumber($number, $array){
        if(array_search(0, $array) == 0){
            $number = $array[0];
        }
        elseif(array_search(0, $array) == 2){
            $number = $array[2];
        }
        print_r($array);
        echo "<br>";
    }
?>