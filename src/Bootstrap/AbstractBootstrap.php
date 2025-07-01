<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use HeyCart\Core\Framework\Plugin\Context\InstallContext;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @internal
 */
abstract class AbstractBootstrap
{
    protected InstallContext $installContext;

    protected ContainerInterface $container;

    abstract public function install(): void;

    abstract public function update(): void;

    abstract public function uninstall(bool $keepUserData = false): void;

    abstract public function activate(): void;

    abstract public function deactivate(): void;

    public function injectServices(): void
    {
    }

    final public function setInstallContext(InstallContext $installContext): void
    {
        $this->installContext = $installContext;
    }

    public function preInstall(): void
    {
    }

    public function preUpdate(): void
    {
    }

    public function preUninstall(bool $keepUserData = false): void
    {
    }

    public function preActivate(): void
    {
    }

    public function preDeactivate(): void
    {
    }

    public function postActivate(): void
    {
    }

    public function postDeactivate(): void
    {
    }

    public function postUninstall(): void
    {
    }

    public function postUpdate(): void
    {
    }

    public function postInstall(): void
    {
    }

    final public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}
