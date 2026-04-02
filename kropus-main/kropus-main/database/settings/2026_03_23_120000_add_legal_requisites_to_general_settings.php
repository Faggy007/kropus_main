<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.legal_full_name', null);
        $this->migrator->add('general.inn', null);
        $this->migrator->add('general.ogrn', null);
    }
};
