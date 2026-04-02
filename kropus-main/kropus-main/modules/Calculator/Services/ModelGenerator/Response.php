<?php

namespace Modules\Calculator\Services\ModelGenerator;

class Response
{
    public function __construct(
        public string $glbPath,
        public string $stepPath
    )
    {
    }
}
