<?php

$con = mysqli_connect('some-mysql', 'root', 'secret-secret', 'login');

// $con = mysqli_connect('localhost', 'root', '', 'login');

function row_count($result)
{
    return mysqli_num_rows($result);
}

// function print_con(){
//     global $con;
//     var_dump(mysqli_error($con));
//      var_dump($con);
//      var_dump(mysqli_connect_errno());
// }
function escape($string)
{
    global $con;
    return mysqli_real_escape_string($con, $string);
}

function confirm($result)
{
    global $con;

    if(!$result)
    {
        die("QUERY FAILED" . mysqli_error($con));
    }
}

function query($query)
{
    global $con;
    return mysqli_query($con, $query);
    confirm($result);
}


function fetch_array($result)
{
    global $con;
    return mysqli_fetch_array($result);
}

?>