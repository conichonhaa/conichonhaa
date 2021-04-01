<?php

/**
 * Example footer with a link to a page of information.
 */

declare(strict_types=1);

namespace MyCustomNamespace;

use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Module\ModuleMenuInterface;
use Fisharebest\Webtrees\Module\ModuleMenuTrait;
use Fisharebest\Webtrees\Module\ModuleListInterface;
use Fisharebest\Webtrees\Module\ModuleListTrait;
use Fisharebest\Webtrees\Module\ModuleFooterInterface;
use Fisharebest\Webtrees\Module\ModuleFooterTrait;
use Fisharebest\Webtrees\Http\RequestHandlers\ControlPanel;
use Fisharebest\Webtrees\Http\RequestHandlers\ManageTrees;
use Fisharebest\Webtrees\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Fisharebest\Webtrees\Menu;
use Fisharebest\Webtrees\Tree;

return new class extends AbstractModule implements ModuleCustomInterface, ModuleMenuInterface, ModuleListInterface, ModuleFooterInterface {
    use ModuleCustomTrait;
    use ModuleMenuTrait;
    use ModuleListTrait;
    use ModuleFooterTrait;

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Correction';
    }

    /**
     * Bootstrap the module
     */
    public function boot(): void
    {
        // Register a namespace for our views.
        View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');
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
     * A footer, to be added at the bottom of every page.
     *
     * @param ServerRequestInterface $request
     *
     * @return string
     */
    public function getFooter(ServerRequestInterface $request): string
    {
        $tree = $request->getAttribute('tree');

        $url = route('module', [
            'module' => $this->name(),
            'action' => 'Page',
            'tree'   => $tree ? $tree->name() : null,
        ]);

        return view($this->name() . '::footer', ['url' => $url]);
    }

    /**
     * Generate the page that will be shown when we click the link in the footer.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function getPageAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->viewResponse($this->name() . '::page', [
            'title' => $this->title(),
            'tree'  => $request->getAttribute('tree'),
        ]);
    }
};
