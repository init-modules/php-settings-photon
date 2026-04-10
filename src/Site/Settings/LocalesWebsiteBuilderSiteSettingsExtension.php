<?php

namespace Init\SettingsWebsiteBuilder\Site\Settings;

use Init\Settings\Support\LocaleRegistry;
use Init\WebsiteBuilder\Site\Contracts\WebsiteBuilderSiteSettingsExtension;

class LocalesWebsiteBuilderSiteSettingsExtension implements WebsiteBuilderSiteSettingsExtension
{
    public function __construct(
        protected LocaleRegistry $localeRegistry,
    ) {
    }

    public function key(): string
    {
        return 'locales';
    }

    public function resolve(): array
    {
        return [
            'items' => $this->localeRegistry->all(),
        ];
    }

    public function persist(mixed $value): void
    {
        if (! is_array($value)) {
            return;
        }

        $items = $value['items'] ?? null;

        if (! is_array($items)) {
            return;
        }

        $this->localeRegistry->replace($items);
    }
}
