<?php

DEFINE ('DB_HOSTNAME', '81.31.151.15');
DEFINE ('DB_DATABASE', 'interna5_svagiaz');
DEFINE ('DB_USERNAME', 'inter_Usazag');
DEFINE ('DB_PASSWORD', 'Zs!4q9s0');


 
 $connection = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 mysqli_set_charset($connection, "utf8");