<?php

namespace Init\SettingsWebsiteBuilder;

use Init\SettingsWebsiteBuilder\Site\Settings\LocalesWebsiteBuilderSiteSettingsExtension;
use Init\WebsiteBuilder\Site\Registry\WebsiteBuilderSiteSettingsExtensionRegistry;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RootServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('settings-website-builder');
    }

    public function packageBooted(): void
    {
        $this->app->make(WebsiteBuilderSiteSettingsExtensionRegistry::class)
            ->register($this->app->make(LocalesWebsiteBuilderSiteSettingsExtension::class));
    }
}
