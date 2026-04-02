<?php

namespace App\Providers;

use App\Shortcodes\TestShortcode;
use Illuminate\Support\ServiceProvider;
use Modules\Blog\Models\Category as BlogCategory;
use Modules\Blog\Models\Post as BlogPost;
use Modules\Blog\Services\Sitemap\CategorySitemapRepository;
use Modules\Blog\Services\Sitemap\PostSitemapRepository;
use Modules\Blog\Services\UrlService\BlogCategoryEntityUrlResolver;
use Modules\Blog\Services\UrlService\BlogPostEntityUrlResolver;
use Modules\Calculator\Providers\CalculatorServiceProvider;
use Modules\Common\Provider\CommonServiceProvider;
use Modules\Common\Services\Sitemap\ChainSitemapRepository;
use Modules\Common\Services\Sitemap\SitemapRepository;
use Modules\Common\Services\UrlService\EntityUrlResolver;
use Modules\Common\Services\UrlService\InstanceEntityUrlResolver;
use Modules\ContactForm\Providers\ContactFormServiceProvider;
use Modules\Frontend\Providers\FrontendServiceProvider;
use Modules\Shop\Models\Category as ShopCategory;
use Modules\Shop\Models\ProductVariant as ShopProductVariant;
use Modules\Shop\Services\Sitemap\ProductSitemapRepository;
use Modules\Shop\Services\Sitemap\ProductVariantSitemapRepository;
use Modules\Shop\Services\UrlService\ShopCategoryEntityUrlResolver;
use Modules\Shop\Services\UrlService\ShopProductEntityUrlResolver;
use Modules\Shop\Services\UrlService\ShopProductVariantEntityUrlResolver;
use Vedmant\LaravelShortcodes\Facades\Shortcodes;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(CommonServiceProvider::class);
        $this->app->register(FrontendServiceProvider::class);
        $this->app->register(ContactFormServiceProvider::class);
        $this->app->register(CalculatorServiceProvider::class);

        $this->app->singleton(EntityUrlResolver::class, function () {
            return new InstanceEntityUrlResolver([
                BlogPost::class => new BlogPostEntityUrlResolver(),
                BlogCategory::class => new BlogCategoryEntityUrlResolver(),
                ShopCategory::class => new ShopCategoryEntityUrlResolver(),
                ShopProductVariant::class => new ShopProductVariantEntityUrlResolver(),
            ]);
        });

        $this->app->singleton(SitemapRepository::class, function ($app) {
            return new ChainSitemapRepository([
                $app->make(PostSitemapRepository::class),
                $app->make(CategorySitemapRepository::class),
                $app->make(ProductSitemapRepository::class),
                $app->make(ProductVariantSitemapRepository::class),
            ]);
        });
    }

    public function boot(): void
    {
        Shortcodes::add('test', TestShortcode::class);
    }
}
