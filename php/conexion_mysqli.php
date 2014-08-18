<?php
 
function conexion_mysqli(){
    $DBServer = 'sql4.freemysqlhosting.net'; // e.g 'localhost' or '192.168.1.100'
    $DBUser   = 'sql435018';
    $DBPass   = 'eP9*fH2%';
    $DBName   = 'sql435018';
    
    $con = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
    
    if ($con->connect_error) {
        trigger_error('Database connection failed: '  . $con->connect_error, E_USER_ERROR);
    }
    else{
        return $con;
    }
        
}

conexion_mysqli();
