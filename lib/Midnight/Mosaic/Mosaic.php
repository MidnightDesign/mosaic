<?php


namespace Midnight\Mosaic;
use Midnight\Mosaic\Exception\SpaceIsOccupiedException;
use Midnight\Mosaic\Tile\PositionedTile;
use Midnight\Mosaic\Tile\PositionedTileInterface;
use Midnight\Mosaic\Tile\TileInterface;


/**
 * Class Mosaic
 *
 * @package Midnight\Mosaic
 */
class Mosaic implements MosaicInterface
{

    /**
     * @var int
     */
    protected $width;
    /**
     * @var int
     */
    protected $height;

    /**
     * @var PositionedTileInterface
     */
    protected $tiles = array();

    protected $occupiedTiles = array();

    /**
     * @param int $height
     * @param int $width
     */
    public function __construct($width, $height)
    {
        $this->height = $height;
        $this->width = $width;
        $this->resetOccupiedTiles();
    }

    /**
     * @param TileInterface $tile
     * @param int $x
     * @param int $y
     *
     * @throws OutOfBoundsException
     * @throws SpaceIsOccupiedException
     */
    public function addTile(TileInterface $tile, $x, $y)
    {
        $width = $tile->getWidth();
        $height = $tile->getHeight();
        if ($x < 0 || $y < 0 || $x + $width > $this->width || $y + $height > $this->height) {
            throw new OutOfBoundsException();
        }
        if (!$this->isFree($x, $y, $width, $height)) {
            throw new SpaceIsOccupiedException($x, $y, $width, $height);
        }
        $this->tiles[] = new PositionedTile($tile, $x, $y);
        for ($curry = $y; $curry < $y + $height; $curry++) {
            for ($currx = $x; $currx < $x + $width; $currx++) {
                $this->occupiedTiles[$curry][$currx] = true;
            }
        }
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     *
     * @return bool
     */
    public function isFree($x, $y, $width, $height)
    {
//        echo PHP_EOL . 'Testing ' . $x . '/' . $y . ' -> ' . ($x + $width - 1) . '/' . ($y + $height - 1) . '...' . PHP_EOL;
//        echo PHP_EOL;
//        foreach ($this->occupiedTiles as $row) {
//            foreach ($row as $field) {
//                echo $field ? 'X' : 'O';
//            }
//            echo PHP_EOL;
//        }
        for ($curry = $y; $curry < $y + $height; $curry++) {
            for ($currx = $x; $currx < $x + $width; $currx++) {
                if ($this->occupiedTiles[$curry][$currx] === true) {
                    return false;
                }
            }
        }
        return true;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function clearTiles()
    {
        $this->tiles = array();
        $this->resetOccupiedTiles();
    }

    private function resetOccupiedTiles()
    {
        $height = $this->getHeight();
        $width = $this->getWidth();
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                if (!isset($this->occupiedTiles[$y])) {
                    $this->occupiedTiles[$y] = array($height);
                }
                $this->occupiedTiles[$y][$x] = false;
            }
        }
    }

    /**
     * @return PositionedTileInterface[]
     */
    public function getTiles()
    {
        return $this->tiles;
    }
}