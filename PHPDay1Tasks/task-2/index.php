<?php

$x=5;
$y="Welcome";
$z=true;

$m=30;
$n=25;

$result=$m+$n;

$strings=[
"PHP",
"HTML",
"CSS",
"Bootstrap",
"JavaScript"
];

function numberToString($number)
{
    return strval($number);
}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>php task-2</title>

<?php require("cssCdn.php"); ?>

</head>

<body>

<div class="container mt-5">

<h1 class="text-center mb-5">
PHP task-2
</h1>


<!-- Question 1 -->

<div class="card">

<div class="card-header">
Question 1
</div>

<div class="card-body">

Welcome to PHP

</div>

</div>


<!-- Question 2 -->

<div class="card">

<div class="card-header">
Question 2
</div>

<div class="card-body">

<?php
echo "x = " . $x . "<br>";
echo "y = " . $y . "<br>";
echo "z = " . $z . "<br>";

?>

</div>

</div>



<!-- Question 3 -->

<div class="card">

<div class="card-header">
Question 3
</div>

<div class="card-body">

<?php

echo gettype($x)."<br>";
echo gettype($y)."<br>";
echo gettype($z);

?>

</div>

</div>



<!-- Question 4 -->

<div class="card">

<div class="card-header">
Question 4
</div>

<div class="card-body">

<b>For Loop</b>

<br><br>

<?php

for($i=0;$i<=15;$i++)
echo $i." ";

?>

<hr>

<b>While Loop</b>

<br><br>

<?php

$i=0;

while($i<=15)
{
echo $i." ";
$i++;
}

?>

</div>

</div>



<!-- Question 5 -->

<div class="card">

<div class="card-header">
Question 5
</div>

<div class="card-body">

<?php

define("ITI","ITI");

echo ITI;

?>

</div>

</div>




<!-- Question 6 -->

<div class="card">

<div class="card-header">
Question 6
</div>

<div class="card-body">

<?php

echo gettype($x)."<br>";
echo gettype($y)."<br>";
echo gettype($z);

?>

</div>

</div>




<!-- Question 7 -->

<div class="card">

<div class="card-header">
Question 7
</div>

<div class="card-body">

<?php
echo "x : " . (isset($x) ? "True" : "False") . "<br>";
echo "y : " . (isset($y) ? "True" : "False") . "<br>";
echo "z : " . (isset($z) ? "True" : "False") . "<br>";
?>

</div>

</div>




<!-- Question 8 -->

<div class="card">

<div class="card-header">
Question 8
</div>

<div class="card-body">

<?php

echo "x : " . (empty($x) ? "True" : "False") . "<br>";
echo "y : " . (empty($y) ? "True" : "False") . "<br>";
echo "z : " . (empty($z) ? "True" : "False") . "<br>";

?>

</div>

</div>




<!-- Question 9 -->

<div class="card">

<div class="card-header">
Question 9
</div>

<div class="card-body">

<<?php
    echo "m = " . $m . "<br>";
    echo "n = " . $n . "<br>";
    echo "Result = " . $result . "<br>";

    if ($result > 50) {
        echo "Accepted";
    } else {
        echo "Not accepted";
    }
    ?>

</div>

</div>




<!-- Question 10 -->

<div class="card">

<div class="card-header">
Question 10
</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<tr class="table-primary">

<th>ID</th>

<th>Language</th>

</tr>

<?php
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><td>Salary of Mr. A is</td><td>1000$</td></tr>";
    echo "<tr><td>Salary of Mr. B is</td><td>1200$</td></tr>";
    echo "<tr><td>Salary of Mr. C is</td><td>1400$</td></tr>";
    echo "</table>";
    ?>

</table>

</div>

</div>




<!-- Number To String -->

<div class="card">

<div class="card-header">
Bonus
</div>

<div class="card-body">

<?php
    echo numberToString(123);
    echo "<br>";
    echo numberToString(999);
    ?>

</div>

</div>

</div>

<?php require("jsCdn.php"); ?>

</body>

</html>