<?php

namespace utilities;

class CheckMethodUtility
{
    public static function checkPost()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('No se ha mandado por el método POST');
        }
    }
}