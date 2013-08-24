<?php


namespace Midnight\Mosaic\Tile;

/**
 * Class Tile
 *
 * @package Midnight\Mosaic\TileInterface
 */
class Tile implements TileInterface
{
    /**
     * @var int
     */
    protected $width;
    /**
     * @var int
     */
    protected $height;

    function __construct($width = 1, $height = 1)
    {
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }
}