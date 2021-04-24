<?php
$f3 = require('fatfree/lib/base.php');
$f3->set('db', new DB\SQL(
 'mysql:host=localhost;port=3306;dbname=helpdesk',  
'root',	  
'')	
);

?>