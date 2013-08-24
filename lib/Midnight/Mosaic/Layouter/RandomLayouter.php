<?php


namespace Midnight\Mosaic\Layouter;

use Midnight\Mosaic\Exception\SpaceIsOccupiedException;
use Midnight\Mosaic\MosaicInterface;
use Midnight\Mosaic\Tile\TileInterface;

class RandomLayouter implements LayouterInterface
{

    /**
     * Has proven to be a good value (Tested on a 5 by 5 grid)
     *
     * @var int
     */
    protected $retriesPerTile = 150;

    protected $occupied = array();

    protected $sorted = false;

    /**
     * @param MosaicInterface $mosaic
     * @param TileInterface[] $tiles
     *
     * @return mixed|void
     */
    public function layout(MosaicInterface $mosaic, array $tiles)
    {
        // Start with the biggest tiles
        if (!$this->sorted) {
            usort($tiles, array($this, 'sort'));
            $tiles = array_reverse($tiles);
            $this->sorted = true;
        }

        $this->occupied = array();
        $mosaic->clearTiles();
        for ($i = 0; $i < count($tiles); $i++) {
            $tile = $tiles[$i];
            $found_spot = false;
            $try_count = 0;
            do {
                $x = mt_rand(0, $mosaic->getWidth() - $tile->getWidth());
                $y = mt_rand(0, $mosaic->getHeight() - $tile->getHeight());

                $occupiedKey = join('/', array($x, $y, $tile->getWidth(), $tile->getHeight()));
                if (isset($this->occupied[$occupiedKey])) {
                    continue 1;
                }

                $try_count += 1;
                try {
                    $mosaic->addTile($tile, $x, $y);
                    $found_spot = true;
                } catch (SpaceIsOccupiedException $e) {
                }
                $this->occupied[$occupiedKey] = true;
            } while ($found_spot === false && $try_count < $this->retriesPerTile);
        }
        if (count($mosaic->getTiles()) !== count($tiles)) {
            $mosaic->clearTiles();
            $this->layout($mosaic, $tiles);
        }
        return count($mosaic->getTiles()) === count($tiles);
    }

    /**
     * @param int $retriesPerTile
     */
    public function setRetriesPerTile($retriesPerTile)
    {
        $this->retriesPerTile = $retriesPerTile;
    }

    /**
     * @param \Midnight\Mosaic\Tile\TileInterface $a
     * @param \Midnight\Mosaic\Tile\TileInterface $b
     *
     * @return int
     */
    public function sort(TileInterface $a, TileInterface $b)
    {
        $area_a = $a->getWidth() * $a->getHeight();
        $area_b = $b->getWidth() * $b->getHeight();
        if ($area_a == $area_b) {
            return 0;
        }
        return ($area_a < $area_b) ? -1 : 1;
    }
}