<?php
    
   $servername = $_SERVER['SERVER_NAME'];
   $port = $_SERVER['SERVER_PORT'];
   $rootlink;
   
      if($servername != 'localhost')
            $rootlink = 'https://'.$servername.':'.$port.'/'.'yaboiguiservice/';
       else 
            $rootlink = 'http://'.$servername.':'.$port.'/'.'yaboiguiservice/';

?>