<?php

namespace Modules\Common\Services\IconService;

use DOMDocument;
use Stringable;

class Icon implements Stringable
{
    protected DOMDocument $dom;

    public function __construct(
        string $svgContent
    )
    {
        $this->dom = new DOMDocument();
        $this->dom->loadXML($svgContent);
    }

    public static function fromPath(string $path): static
    {
        return new static(file_get_contents($path));
    }

    public function class(string $class): static
    {
        $this->getSvgDom()->setAttribute('class', $class);
        return $this;
    }

    public function fill(string $color): static
    {
        $this->getSvgDom()->setAttribute('fill', $color);
        return $this;
    }

    protected function getSvgDom()
    {
        return $this->dom->getElementsByTagName('svg')->item(0);
    }

    public function __toString()
    {
        return $this->dom->saveXML();
    }
}
