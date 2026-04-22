<?php

namespace Init\SettingsPhoton\Site\Settings;

use Init\Settings\Support\LocaleRegistry;
use Init\Photon\Site\Contracts\PhotonSiteSettingsExtension;
use Init\Photon\Workspace\PhotonWorkspace;
use Init\Photon\Workspace\PhotonWorkspaceStore;

class LocalesPhotonSiteSettingsExtension implements PhotonSiteSettingsExtension
{
    public function __construct(
        protected LocaleRegistry $localeRegistry,
        protected PhotonWorkspaceStore $workspaceStore,
    ) {
    }

    public function key(): string
    {
        return 'locales';
    }

    public function resolve(PhotonWorkspace $workspace): array
    {
        if (! $workspace->isDefault()) {
            return [
                'items' => $this->workspaceStore->get($workspace, 'site-setting:' . $this->key())['items']
                    ?? $this->localeRegistry->all(),
            ];
        }

        return [
            'items' => $this->localeRegistry->all(),
        ];
    }

    public function persist(PhotonWorkspace $workspace, mixed $value): void
    {
        if (! is_array($value)) {
            return;
        }

        $items = $value['items'] ?? null;

        if (! is_array($items)) {
            return;
        }

        if (! $workspace->isDefault()) {
            $this->workspaceStore->put($workspace, 'site-setting:' . $this->key(), [
                'items' => array_values($items),
            ]);

            return;
        }

        $this->localeRegistry->replace($items);
    }
}
