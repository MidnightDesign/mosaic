<?php

namespace Midnight\Mosaic;

use Midnight\Mosaic\Tile\PositionedTileInterface;
use Midnight\Mosaic\Tile\TileInterface;

interface MosaicInterface
{
    /**
     * @return int
     */
    public function getWidth();

    /**
     * @return int
     */
    public function getHeight();

    /**
     * @param TileInterface $tile
     * @param int $x
     * @param int $y
     */
    public function addTile(TileInterface $tile, $x, $y);

    /**
     * @return PositionedTileInterface[]
     */
    public function getTiles();

    public function clearTiles();
}