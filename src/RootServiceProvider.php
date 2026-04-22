<?php

namespace Init\SettingsPhoton;

use Init\SettingsPhoton\Site\Settings\LocalesPhotonSiteSettingsExtension;
use Init\Photon\Site\Registry\PhotonSiteSettingsExtensionRegistry;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RootServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('settings-photon');
    }

    public function packageBooted(): void
    {
        $this->app->make(PhotonSiteSettingsExtensionRegistry::class)
            ->register($this->app->make(LocalesPhotonSiteSettingsExtension::class));
    }
}
