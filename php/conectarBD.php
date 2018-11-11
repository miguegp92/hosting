<?php

function conectar() {
    $host = "p:localhost";
    $user = "root";
    $password = "";

    $descriptor = mysqli_connect($host, $user, $password) or die("No ha sido posible conectar con la base de datos");
    return $descriptor;
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

