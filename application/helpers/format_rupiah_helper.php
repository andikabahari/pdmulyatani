<?php

function format_rupiah($value)
{
    return number_format($value, 2, ',', '.');
} 