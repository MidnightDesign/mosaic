<?php


namespace Midnight\Mosaic\Tile;

interface TileInterface
{
    /**
     * @return int
     */
    public function getWidth();

    /**
     * @return int
     */
    public function getHeight();
}