<?php

function ifset(&$var)
{
    return isset($var) ? $var : null;
}