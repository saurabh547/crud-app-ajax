<?php

$con = new mysqli("localhost", "root", "", "bootstrapcrud");

if (!$con) {
    die(mysqli_errno($con));

}

?>