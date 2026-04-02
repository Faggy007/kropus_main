<?php

namespace App\Filament\Modules\ContactForm\ContactFormResource\Pages;

use App\Filament\Modules\ContactForm\ContactFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactForms extends ListRecords
{
    protected static string $resource = ContactFormResource::class;
}
