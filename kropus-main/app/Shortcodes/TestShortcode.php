<?php

namespace App\Shortcodes;

use Vedmant\LaravelShortcodes\Shortcode;

class TestShortcode extends Shortcode
{
    public function render($content)
    {
        return $this->view('shortcodes.test');
    }
}
