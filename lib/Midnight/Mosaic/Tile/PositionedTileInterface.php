<?php


namespace Midnight\Mosaic\Tile;

use Midnight\Mosaic\Tile\TileInterface;

interface PositionedTileInterface
{
    /**
     * @return TileInterface
     */
    public function getTile();

    /**
     * @return int
     */
    public function getX();

    /**
     * @return int
     */
    public function getY();
}