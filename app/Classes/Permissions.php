<?php

namespace App\Classes;

class Permissions
{
    const VIEW = 'VIEW';
    const EDIT = 'EDIT';
    const CREATE = 'CREATE';
    const DELETE = 'DELETE';

    /**
     * @return string[]
     */
    public static function getAll()
    {
        return [
            self::VIEW,
            self::EDIT,
            self::CREATE,
            self::DELETE
        ];
    }
}
