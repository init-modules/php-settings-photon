<?php

namespace Init\SettingsWebsiteBuilder\Site\Settings;

use Init\Settings\Support\LocaleRegistry;
use Init\WebsiteBuilder\Site\Contracts\WebsiteBuilderSiteSettingsExtension;
use Init\WebsiteBuilder\Workspace\WebsiteBuilderWorkspace;
use Init\WebsiteBuilder\Workspace\WebsiteBuilderWorkspaceStore;

class LocalesWebsiteBuilderSiteSettingsExtension implements WebsiteBuilderSiteSettingsExtension
{
    public function __construct(
        protected LocaleRegistry $localeRegistry,
        protected WebsiteBuilderWorkspaceStore $workspaceStore,
    ) {
    }

    public function key(): string
    {
        return 'locales';
    }

    public function resolve(WebsiteBuilderWorkspace $workspace): array
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

    public function persist(WebsiteBuilderWorkspace $workspace, mixed $value): void
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
