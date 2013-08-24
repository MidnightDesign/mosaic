<?php


namespace Midnight\Mosaic\Layouter;

use Midnight\Mosaic\MosaicInterface;
use Midnight\Mosaic\Tile\TileInterface;

interface LayouterInterface
{

    /**
     * @param MosaicInterface $mosaic
     * @param TileInterface[] $tiles
     */
    public function layout(MosaicInterface $mosaic, array $tiles);
}