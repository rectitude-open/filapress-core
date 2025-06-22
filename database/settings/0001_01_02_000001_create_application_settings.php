<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('system.site_name', 'FilaPress');
        $this->migrator->add('system.site_title', '');
        $this->migrator->add('system.site_url', '');
        $this->migrator->add('system.site_description', '');
        $this->migrator->add('system.site_logo', '');
        $this->migrator->add('system.site_favicon', '');
        $this->migrator->add('system.mail_from_email', '');
        $this->migrator->add('system.mail_from_name', '');
        $this->migrator->add('system.mail_host', '');
        $this->migrator->add('system.mail_port', '465');
        $this->migrator->add('system.mail_username', '');
        $this->migrator->add('system.mail_password', '');
        $this->migrator->add('system.login_attempts_rate_limit', 3);
        $this->migrator->add('system.login_attempts_lockout_window', 60);
        $this->migrator->add('system.login_attempts_lockout_attempts', 5);
        $this->migrator->add('system.login_attempts_lockout_duration', 60);
        $this->migrator->add('system.enable_login_captcha', false);
    }
};
