<?php

namespace Midnight\Mosaic\Renderer;

use Midnight\Mosaic\MosaicInterface;

interface RendererInterface
{

    public function render(MosaicInterface $mosaic);
}