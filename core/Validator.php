<?php

class   Validator
{
    public static function XSS($data)
    {
        return htmlspecialchars(trim($data));
    }
}
