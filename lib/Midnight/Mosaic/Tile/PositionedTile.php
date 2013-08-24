<?php


namespace Midnight\Mosaic\Tile;

class PositionedTile implements PositionedTileInterface
{
    /**
     * @var TileInterface
     */
    protected $tile;
    /**
     * @var int
     */
    protected $x;
    /**
     * @var int
     */
    protected $y;

    /**
     * @param TileInterface $tile
     * @param int $x
     * @param int $y
     */
    function __construct(TileInterface $tile, $x, $y)
    {
        $this->tile = $tile;
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return TileInterface
     */
    public function getTile()
    {
        return $this->tile;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }
}