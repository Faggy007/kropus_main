<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Blog\Models\Post;
use Modules\Common\Scopes\PublicStatus\Published;
use Modules\Common\Scopes\PublicStatus\PublishedOrPrivate;
use Modules\Shop\Models\ProductVariant;

class PublicStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->get('private_mode') &&
            $request->get('private_mode') === config('private_mode.key')
        ) {
            $request->session()->put('private_mode', true);
        }

        $showPrivate = $request->session()->get('private_mode');
        if ($showPrivate) {
            Post::addGlobalScope(PublishedOrPrivate::class);
            ProductVariant::addGlobalScope(PublishedOrPrivate::class);
        } else {
            Post::addGlobalScope(Published::class);
            ProductVariant::addGlobalScope(Published::class);
        }

        return $next($request);
    }
}
