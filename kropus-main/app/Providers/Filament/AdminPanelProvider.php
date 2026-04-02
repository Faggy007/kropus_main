<?php

namespace App\Providers\Filament;

use App\Filament\Modules\Blog\Resources\CategoryResource as BlogCategoryResource;
use App\Filament\Modules\Blog\Resources\PostResource as BlogPostResource;
use App\Filament\Modules\Shop\Resources\UnitResource as ShopUnitResource;
use App\Filament\Modules\Shop\Resources\CategoryResource as ShopCategoryResource;
use App\Filament\Modules\Shop\Resources\ProductVariantResource as ShopProductVariantResource;
use App\Filament\Modules\Shop\Resources\ModifierResource as ShopModifierResource;
use App\Filament\Modules\Shop\Resources\ProductResource as ShopProductResource;
use App\Filament\Modules\Shop\Resources\AttributeResource as ShopAttributeResource;
use App\Filament\Modules\ContactForm\ContactFormResource;
use App\Filament\Pages\ManageBitrix24;
use App\Filament\Pages\ManageContactForm;
use App\Filament\Pages\ManageGeneral;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->pages([
                Pages\Dashboard::class,
                ManageGeneral::class,
                ManageContactForm::class,
                ManageBitrix24::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->resources([
                BlogPostResource::class,
                BlogCategoryResource::class,
                ContactFormResource::class,
                ShopUnitResource::class,
                ShopCategoryResource::class,
                ShopProductVariantResource::class,
                ShopModifierResource::class,
                ShopProductResource::class,
                ShopAttributeResource::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make('Блог')->items([
                        ...BlogPostResource::getNavigationItems(),
                        ...BlogCategoryResource::getNavigationItems(),
                    ]),
                    NavigationGroup::make('Каталог')->items([
                        ...ShopProductResource::getNavigationItems(),
                        ...ShopProductVariantResource::getNavigationItems(),
                        ...ShopCategoryResource::getNavigationItems(),
                        ...ShopModifierResource::getNavigationItems(),
                        ...ShopAttributeResource::getNavigationItems(),
                        ...ShopUnitResource::getNavigationItems(),
                    ]),
                    NavigationGroup::make('Остальное')->items([
                        ...ContactFormResource::getNavigationItems(),
                    ]),
                    NavigationGroup::make('Настройки')->items([
                        ...ManageGeneral::getNavigationItems(),
                        ...ManageContactForm::getNavigationItems(),
                        ...ManageBitrix24::getNavigationItems(),
                    ]),
                ]);
            })
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
