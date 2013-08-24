<?php


namespace Midnight\Mosaic\Exception;

use Exception;

class SpaceIsOccupiedException extends Exception
{

    /**
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     * @param int $errx
     * @param int $erry
     */
    function __construct($x, $y, $width, $height, $errx = null, $erry = null)
    {
        parent::__construct('The space from ' . $x . '/' . $y . ' to ' . ($x + $width) . '/' . ($y + $height) . ' is already occupied' . (!is_null($errx) && !is_null($erry) ? ' at ' . $errx . '/' . $erry : '') . '.');
    }
}