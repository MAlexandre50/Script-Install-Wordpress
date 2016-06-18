<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 18/06/2016
 * Time: 16:57
 */

$rootPassword = $_POST['rootpassword'];
$dbName = $_POST['dbname'];
$userName = $_POST['username'];
$userPassword = $_POST['userpassword'];
$wpUrl = $_POST['wpurl'];

//Delete old config file
exec('rm config.xml');

//Create a new config file
$xml = new DOMDocument();
$xml1 = $xml->createElement("mySqlRootPassword");
$xml1->nodeValue = $rootPassword;
$xml->appendChild( $xml1 );

$xml1 = $xml->createElement("dataBaseName");
$xml1->nodeValue = $dbName;
$xml->appendChild( $xml1 );

$xml2 = $xml->createElement("dataBaseUserName");
$xml2->nodeValue = $userName;
$xml->appendChild( $xml2 );

$xml3 = $xml->createElement("dataBasePassword");
$xml3->nodeValue = $userPassword;
$xml->appendChild( $xml3 );

$xml4 = $xml->createElement("wordpressUrl");
$xml4->nodeValue = $wpUrl;
$xml->appendChild( $xml4 );

$xml->save("config.xml");

exec('sh WPInstall.sh',$result);



?>

