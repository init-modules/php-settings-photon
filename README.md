# init/settings-website-builder

Website Builder bridge for shared locale settings.

## Назначение

init/settings-website-builder — Laravel/Composer package; Website Builder integration or runtime layer; settings/locale layer. Пакет подключается как отдельный Composer-модуль и держит свою область ответственности внутри namespace <code>Init\SettingsWebsiteBuilder\</code>.

- Этот пакет находится в слое Website Builder. Доменная логика должна оставаться в базовых пакетах, а здесь должны быть только адаптеры, настройки страниц, runtime-провайдеры или UI-kit для конструктора.

## Установка

~~~bash
composer require init/settings-website-builder
~~~

После установки проверьте регистрацию provider и конфигов в host-приложении.

## Интеграция

Laravel service provider автообнаружения: <code>Init\SettingsWebsiteBuilder\RootServiceProvider</code>.

PSR-4 namespace:
- <code>Init\SettingsWebsiteBuilder\</code>

Конфиги пакета не обнаружены.

Маршруты пакета не обнаружены.

## Состав пакета

- **Root**: <code>RootServiceProvider.php</code>
- **Site**: <code>Site/Settings/LocalesWebsiteBuilderSiteSettingsExtension.php</code>

## Основные точки расширения

- Основная точка входа сейчас находится в <code>RootServiceProvider</code> и регистрационных классах пакета.

## Данные

Миграции не обнаружены.

Сидеры не обнаружены.

## Зависимости

Внутренние пакеты Init:
- <code>init/settings ^1.0</code>
- <code>init/website-builder ^1.0</code>

Внешние runtime-зависимости:
- <code>spatie/laravel-package-tools ^1.16</code>

## Разработка

- держите публичные контракты и DTO в <code>src/Contracts</code>, <code>src/Data</code> или ближайших существующих каталогах;
- регистрируйте Laravel bindings, migrations, routes, commands и Filament plugins через <code>RootServiceProvider</code>;
- если пакет является интеграционным слоем, не переносите в него базовую доменную модель;
- перед релизом проверьте autoload и минимальный сценарий подключения из host-приложения.
