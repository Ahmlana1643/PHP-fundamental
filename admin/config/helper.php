<?php

//sanitize input
if (!function_exists('sanitize')) {
    
function sanitize($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
}
}