<?php


namespace Midnight\Mosaic\Renderer;

use Midnight\Mosaic\MosaicInterface;
use Midnight\Mosaic\Tile\PositionedTileInterface;

class HtmlApRenderer implements RendererInterface
{

    protected $tile_size = 200;
    protected $length_unit = 'px';

    public function render(MosaicInterface $mosaic)
    {
        $tiles = $this->renderTiles($mosaic->getTiles());
        return '<div style="width: ' . $this->length($mosaic->getWidth()) . '; height: ' . $this->length($mosaic->getHeight()) . '; position: relative;">' . $tiles . '</div>';
    }

    /**
     * @param PositionedTileInterface[] $tiles
     *
     * @return string
     */
    private function renderTiles(array $tiles)
    {
        $r = array();
        foreach ($tiles as $tile) {
            $r[] = $this->renderTile($tile);
        }
        return join(PHP_EOL, $r);
    }

    /**
     * @param PositionedTileInterface $positioned_tile
     *
     * @return string
     */
    protected function renderTile(PositionedTileInterface $positioned_tile)
    {
        $tile = $positioned_tile->getTile();
        $color = '#' . substr(md5($tile->getWidth() . $tile->getHeight()), mt_rand(0, 25), 6); // $positioned_tile->getX() . $positioned_tile->getY() .
        return '<div style="width: ' . $this->length($tile->getWidth()) . '; height: ' . $this->length($tile->getHeight()) . '; position: absolute; left: ' . $this->length($positioned_tile->getX()) . '; top: ' . $this->length($positioned_tile->getY()) . '; background-color: ' . $color . '; box-sizing: border-box; border: solid '.$this->length(.01).' white;"></div>';
    }

    protected function length($length)
    {
        return ($length * $this->tile_size) . $this->length_unit;
    }
}