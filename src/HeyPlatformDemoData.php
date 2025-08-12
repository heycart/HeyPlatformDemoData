<?php declare(strict_types=1);

namespace Hey\PlatformDemoData;

use Hey\PlatformDemoData\Bootstrap\AbstractBootstrap;
use Hey\PlatformDemoData\Bootstrap\CategoryBoostrap;
use Hey\PlatformDemoData\Bootstrap\CmsPageBoostrap;
use Hey\PlatformDemoData\Bootstrap\CustomerBoostrap;
use Hey\PlatformDemoData\Bootstrap\DomainBoostrap;
use Hey\PlatformDemoData\Bootstrap\MediaBoostrap;
use Hey\PlatformDemoData\Bootstrap\ProductBoostrap;
use Hey\PlatformDemoData\Bootstrap\ProductManufacturerBoostrap;
use Hey\PlatformDemoData\Bootstrap\PromotionBoostrap;
use Hey\PlatformDemoData\Bootstrap\PropertyBoostrap;
use Hey\PlatformDemoData\Bootstrap\RuleBoostrap;
use HeyCart\Core\Framework\Plugin;
use HeyCart\Core\Framework\Plugin\Context\InstallContext;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HeyPlatformDemoData extends Plugin
{
    public function install(InstallContext $installContext): void
    {
        $bootstrapper = $this->getBootstrapClasses($installContext);
        foreach ($bootstrapper as $bootstrap) {
            $bootstrap->preInstall();
            $bootstrap->install();
        }
    }

    public function uninstall(Plugin\Context\UninstallContext $uninstallContext): void
    {
        $bootstrapper = $this->getBootstrapClasses($uninstallContext);
        foreach (array_reverse($bootstrapper) as $bootstrap) {
            $bootstrap->preUninstall();
            $bootstrap->uninstall($uninstallContext->keepUserData());
            $bootstrap->postUninstall();
        }
    }

    /**
     * @return AbstractBootstrap[]
     */
    protected function getBootstrapClasses(InstallContext $context): array
    {
        \assert($this->container instanceof ContainerInterface, 'Container is not set yet, please call setContainer() before calling boot(), see `platform/Core/Kernel.php:186`.');
        /** @var AbstractBootstrap[] $bootstrapper */
        $bootstrapper = [
            new MediaBoostrap(),
            new CmsPageBoostrap(),
            new DomainBoostrap(),
            new CategoryBoostrap(),
            new CustomerBoostrap(),
            new RuleBoostrap(),
            new PropertyBoostrap(),
            new PromotionBoostrap(),
            new ProductManufacturerBoostrap(),
            new ProductBoostrap(),
        ];
        foreach ($bootstrapper as $bootstrap) {
            $bootstrap->setInstallContext($context);
            $bootstrap->setContainer($this->container);
            $bootstrap->injectServices();
        }

        return $bootstrapper;
    }
}
