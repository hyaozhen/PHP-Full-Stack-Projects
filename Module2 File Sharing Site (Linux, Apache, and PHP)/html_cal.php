<?php
$num1 = (float) $_POST["num1"];
$num2 = (float) $_POST["num2"];
$operation = $_POST["operation"];

if (htmlentities($operation) == "+"){
	echo "Result: " . ($num1 + $num2);
} elseif (htmlentities($operation) == "-"){
	echo "Result: " . ($num1 - $num2);
} elseif (htmlentities($operation) == "*"){
	echo "Result: " . ($num1 * $num2);
} elseif (htmlentities($operation) == "/" and $num2 != 0){
	echo "Result: " . ($num1 / $num2);
}
  elseif (htmlentities($operation) == "/" and $num2 == 0){
	echo "denominator can not be zero";
}
?>

<a href="./idv_cal_html.html">Go Back</a>