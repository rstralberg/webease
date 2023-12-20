<?php
    
function db_close(mysqli $db) : void {

    if(is_resource($db) && get_resource_type($db)==='mysql link')
    {
        mysqli_close($db); 
    } 
}

