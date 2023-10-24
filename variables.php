


<?php 

$name = "drake";
$url = "www.youtube.com";

echo "<h3>direction</h3>";
echo $url;
echo "<br />";

$url = "www.google.com";
echo $url;
echo "<br />";

$lastName = "lastName";
$message = "first string";

print "$lastName: $message";
echo "<br />";

$height = 183;
echo "Height: $height";
echo "<br />";

$num1=10;
$num2=20;
$total=$num1+$num2;
echo $total;
echo "<br />";

function summary(){
    $var1=30;
    $var2=50;
    $total=$var1+$var2;
    echo $total;
}

summary();
echo "<br />";

global $message;
$message = "hey";
echo $message;
echo "<br />";

static $staticNumber=1;
echo $staticNumber;
echo "<br />";

$hey;
$hey = "Welcome";
echo $GLOBALS["hey"] . "<br>";
echo "<br />";

define("QUOTE",2000);
$valueQuote=QUOTE;
echo "value quote: $valueQuote";
echo "<br />";
echo "value quote: ".QUOTE."<br/>";
echo "<br />";




?>