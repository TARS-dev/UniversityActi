<?php
$conn = oci_connect( 'p604244013', 'PloveJ1601', 'localhost:1521/orcl' ) or die ( oci_error());
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}