<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.address', null);
        $this->migrator->add('general.vk_link', null);
        $this->migrator->add('general.tg_link', null);
        $this->migrator->add('general.max_link', null);
        $this->migrator->add('general.map_iframe', null);
    }
};
