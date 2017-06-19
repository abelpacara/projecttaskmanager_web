<?php
function spanish_date_to_mysql($spanish_date)
{
    list($day, $month, $year) = explode("/", $spanish_date);
    return $year."-".$month."-".$day;
}