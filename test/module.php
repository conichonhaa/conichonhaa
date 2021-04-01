<?php

/**
 * Example theme.  Here we are extending an existing theme.
 * Instead, you could extend AbstractModule and implement ModuleThemeInterface directly.
 */

declare(strict_types=1);

namespace MyCustomNamespace;

use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Module\ModuleListInterface;
use Fisharebest\Webtrees\Module\ModuleListTrait;
use Fisharebest\Webtrees\View;

return new class extends AbstractModule implements ModuleCustomInterface, ModuleListInterface {
    use ModuleCustomTrait;
    use ModuleListTrait;

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Test';
    }

    /**
     * Bootstrap the module
     */
    public function boot(): void
    {
        // Register a namespace for our views.
        View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');

        // Replace an existing view with our own version.
        View::registerCustomView('::page', $this->name() . '::page');
    }

    /**
     * Where does this module store its resources
     *
     * @return string
     */
    public function resourcesFolder(): string
    {
        return __DIR__ . '/resources/';
    }

    /**
     * Add our own stylesheet to the existing stylesheets.
     *
     * @return array<string>
     */
        // NOTE - a future version of webtrees will allow the modules to be stored in a private folder.
        // Only files in the /public/ folder will be accessible via the webserver.
        // Since modules cannot copy their files to the /public/ folder, they need to provide them via a callback.
};
