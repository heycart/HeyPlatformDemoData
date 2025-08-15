<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use Hey\PlatformDemoData\Helper\TranslationHelper;
use HeyCart\Core\Content\Product\Aggregate\ProductManufacturer\ProductManufacturerCollection;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;

/**
 * @internal
 */
class ProductManufacturerBoostrap extends AbstractBootstrap
{
    private Connection $connection;

    private TranslationHelper $translationHelper;

    /**
     * @var EntityRepository<ProductManufacturerCollection>
     */
    private EntityRepository $productManufacturerRepository;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->translationHelper = new TranslationHelper($this->connection);
        $this->productManufacturerRepository = $this->container->get('product_manufacturer.repository');
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getPayload(): array
    {
        return [
            [
                'id' => '01989eac3a8870b89150e2907a46e07c',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => 'Plugin producer',
                    'en-GB' => 'Plugin producer',
                ]),
                'prefix' => 'Hey123',
                'customerId' => '6c97534c2c0747f39e8751e43cb2b013',
            ],
        ];
    }

    public function install(): void
    {
        $context = $this->installContext->getContext();
        $this->productManufacturerRepository->upsert($this->getPayload(), $context);
    }

    public function update(): void
    {
        // TODO: Implement update() method.
    }

    public function uninstall(bool $keepUserData = false): void
    {
        if ($keepUserData) {
            return;
        }
        $context = $this->installContext->getContext();

        $ids = array_map(function ($group) {
            return ['id' => $group['id']];
        }, $this->getPayload());

        $this->productManufacturerRepository->delete($ids, $context);
    }

    public function activate(): void
    {
        // TODO: Implement activate() method.
    }

    public function deactivate(): void
    {
        // TODO: Implement deactivate() method.
    }
}
