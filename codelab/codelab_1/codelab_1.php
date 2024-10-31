<?php

$rows = 5;

for ($i = 1; $i <= $rows; $i++){
    for ($j = $rows; $j >= $i; $j--){
        echo " ";
    }

    for ($j = 1; $j <= $i; $j++){
        echo "* ";
    }

    echo "\n";
}

for ($i = 1; $i <= $rows; $i++){
    for ($j = 1; $j <= $i; $j++){
        echo " ";
    }

    for ($j = $rows; $j >= $i; $j--){
        echo "* ";
    }

    echo "\n";
}