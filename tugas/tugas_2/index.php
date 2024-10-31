<?php

function iniFungsi($input){
    for ($i = 1; $i <= $input; $i++){
        if ($i % 4 == 0 && $i % 6 == 0){
            echo "Pemrograman Website 2024\n";
        } else if ($i % 5 == 0){
            echo "2024\n";
        } else if ($i % 4 == 0 && $i % 6 != 0){
            echo "Pemrograman\n";
        } else if ($i % 4 != 0 && $i % 6 == 0){
            echo "Website\n";
        } else {
            echo "{$i}\n";
        }
    }
}

iniFungsi(25);