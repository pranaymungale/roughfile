<!DOCTYPE html>
<html>
  <body>

<?php

$xmlDoc = new DOMDocument();
$xmlDoc->load("test.xml");

$x = $xmlDoc->documentElement;
foreach ($x->childNodes AS $item) {
  print $item->nodeName . " = " . $item->nodeValue . "<br>";
}











/*
libxml_use_internal_errors(true);
$abc=
"<?xml version='1.0' encoding='UTF-8'?>

<profile>
<user>
<fname>Pranay</fname>
<lname>Mungle</lname>
<email>pranay@gmail.com</email>
</user>

<user>
<fname>saurabh</fname>
<lname>sharma</lname>
<email>sharma@gmail.com</email>
</user>

<user>
<fname>ritik</fname>
<lname>raka</lname>
<email>ritik@gmail.com</email>
</user>

</profile>";

$xml=simplexml_load_string($abc) or die("Error: Cannot create object");
print_r($xml);
$xml = simplexml_load_string($abc);
if ($xml === false) {
  echo "Failed loading XML: ";
  foreach(libxml_get_errors() as $error) {
    echo "<br>", $error->message;
  }
} else {
  print_r($xml);
}

$xml=simplexml_load_file("test.xml") or die("Error: Cannot create object");
$xml=simplexml_load_file("test.xml") or die("Error: Cannot create object");
print_r($xml);
echo $xml->fname . "<br>";
echo $xml->lname . "<br>";
echo $xml->email;
//
echo $xml->user[1]->fname . "<br>";
echo $xml->user[1]->lname . "<br>";
echo $xml->user[1]->email ."<br>";

echo $xml->user[2]->fname . "<br>";
echo $xml->user[2]->lname . "<br>";
echo $xml->user[2]->email . "<br>";

echo $xml->user[0]->fname . "<br>";
echo $xml->user[0]->lname . "<br>";
echo $xml->user[0]->email ."<br>";



$xml=simplexml_load_file("test.xml") or die("Error: Cannot create object");
foreach($xml->user as $value){
echo $value->fname.", ";
echo $value->lname.", ";
echo $value->email."<br>";



}
*/






?>
</body>
</html>