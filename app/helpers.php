<?php

function format_ro_date($date)
{
    return date("d.m.Y", strtotime($date));
}
