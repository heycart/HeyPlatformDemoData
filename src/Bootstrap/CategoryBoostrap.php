<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use Hey\PlatformDemoData\Bootstrap\Category\AudioCategoryL2;
use Hey\PlatformDemoData\Bootstrap\Category\ComputersCategoryL2;
use Hey\PlatformDemoData\Bootstrap\Category\PeripheralsCategoryL2;
use Hey\PlatformDemoData\Helper\TranslationHelper;
use HeyCart\Core\Content\Category\CategoryCollection;
use HeyCart\Core\Defaults;
use HeyCart\Core\Framework\Api\Context\SystemSource;
use HeyCart\Core\Framework\Context;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;
use HeyCart\Core\Framework\DataAbstractionLayer\Search\Criteria;
use HeyCart\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use HeyCart\Core\Framework\Uuid\Uuid;
use HeyCart\Core\System\SalesChannel\SalesChannelCollection;

/**
 * @internal
 */
class CategoryBoostrap extends AbstractBootstrap
{
    /**
     * @var EntityRepository<CategoryCollection>
     */
    private EntityRepository $categoryRepository;

    /**
     * @var EntityRepository<SalesChannelCollection>
     */
    private EntityRepository $salesChannelRepository;

    private Connection $connection;

    private TranslationHelper $translationHelper;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->categoryRepository = $this->container->get('category.repository');
        $this->salesChannelRepository = $this->container->get('sales_channel.repository');
        $this->translationHelper = new TranslationHelper($this->connection);
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getPayload(): array
    {
        $cmsPageId = $this->getDefaultCmsListingPageId();

        return [
            [
                'id' => $this->getRootCategoryId(),
                'cmsPageId' => '695477e02ef643e5a016b83ed4cdf63a',
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => 'HeyCart 电子产品商城演示系统',
                    'en-GB' => 'HeyCart Electronics Products Mall Demo System',
                ]),
                'children' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                        'cmsPageId' => $cmsPageId,
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '手机',
                            'en-GB' => 'Mobile Phones',
                        ]),
                    ],
                    [
                        'id' => 'a515ae260223466f8e37471d279e6406',
                        'cmsPageId' => $cmsPageId,
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'afterCategoryId' => '77b959cf66de4c1590c7f9b7da3982f3',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '电脑',
                            'en-GB' => 'Computers',
                        ]),
                        'children' => (new ComputersCategoryL2($cmsPageId, $this->translationHelper))->getPayload(),
                    ],
                    [
                        'id' => '01969ba7567770ccb426156302a1c187',
                        'cmsPageId' => $cmsPageId,
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'afterCategoryId' => 'a515ae260223466f8e37471d279e6406',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '音频设备',
                            'en-GB' => 'Audio Devices',
                        ]),
                        'children' => (new AudioCategoryL2($cmsPageId, $this->translationHelper))->getPayload(),
                    ],
                    [
                        'id' => '01969bac78b670c4ac0b7e77c7bdbe03',
                        'cmsPageId' => $cmsPageId,
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'afterCategoryId' => '01969ba7567770ccb426156302a1c187',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '外设及存储',
                            'en-GB' => 'Peripherals & Storage',
                        ]),
                        'children' => (new PeripheralsCategoryL2($cmsPageId, $this->translationHelper))->getPayload(),
                    ],
                    [
                        'id' => '01942ce041de71cfbb175364b166dd4d',
                        'cmsPageId' => $cmsPageId,
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => false,
                        'type' => 'page',
                        'afterCategoryId' => '01969bac78b670c4ac0b7e77c7bdbe03',
                        'footerSalesChannels' => [
                            [
                                'id' => $this->getStorefrontSalesChannel(),
                            ],
                        ],
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '页脚导航',
                            'en-GB' => 'Footer navigation',
                        ]),
                        'children' => [
                            [
                                'id' => '01969bc7d51872cbb9c0a08ebcef82db',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'zh-CN' => '帮助与支持',
                                    'en-GB' => 'Help & Support',
                                ]),
                                'children' => [
                                    [
                                        'id' => '01969c92918271a0ac79a4f9a96755ea',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '购物指南',
                                            'en-GB' => 'Shopping Guide',
                                        ]),
                                    ],
                                    [
                                        'id' => '01969c936fdf732f863b4748bd163ade',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'afterCategoryId' => '01969c92918271a0ac79a4f9a96755ea',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '支付方式',
                                            'en-GB' => 'Payment Methods',
                                        ]),
                                    ],
                                    [
                                        'id' => '01969c93c80b70bbaadd3a1c4372ba37',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'afterCategoryId' => '01969c936fdf732f863b4748bd163ade',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '配送与物流',
                                            'en-GB' => 'Shipping & Delivery',
                                        ]),
                                    ],
                                    [
                                        'id' => '01969c94256072bda4eb4d1cd30413f3',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'afterCategoryId' => '01969c93c80b70bbaadd3a1c4372ba37',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '售后服务',
                                            'en-GB' => 'After-Sales Service',
                                        ]),
                                    ],
                                ],
                            ],
                            [
                                'id' => '01969bcb75b2715a81162a8aff0214a8',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'afterCategoryId' => '01969bc7d51872cbb9c0a08ebcef82db',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'zh-CN' => '产品分类',
                                    'en-GB' => 'Product Categories',
                                ]),
                                'children' => [
                                    [
                                        'id' => '01969c9676097247ab2d06d8594e2814',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'afterCategoryId' => '01969c93c80b70bbaadd3a1c4372ba37',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '热卖产品',
                                            'en-GB' => 'Hot Sale Products',
                                        ]),
                                    ],
                                    [
                                        'id' => '01969c96c7b97111921516d53e9fd217',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'afterCategoryId' => '01969c9676097247ab2d06d8594e2814',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '限时抢购',
                                            'en-GB' => 'Limited Time Offers',
                                        ]),
                                    ],
                                    [
                                        'id' => '01969c974987738b8635350a37c32de7',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'afterCategoryId' => '01969c96c7b97111921516d53e9fd217',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '新品上市',
                                            'en-GB' => 'New Arrivals',
                                        ]),
                                    ],
                                    [
                                        'id' => '01969c97b78171948d6e471634360e07',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'afterCategoryId' => '01969c974987738b8635350a37c32de7',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '优惠产品',
                                            'en-GB' => 'Discounted Products',
                                        ]),
                                    ],
                                    [
                                        'id' => '01969c982388709aa5aa394ff8559436',
                                        'cmsPageId' => $cmsPageId,
                                        'active' => true,
                                        'displayNestedProducts' => true,
                                        'visible' => true,
                                        'type' => 'page',
                                        'afterCategoryId' => '01969c97b78171948d6e471634360e07',
                                        'name' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => '清仓特卖',
                                            'en-GB' => 'Clearance Sale',
                                        ]),
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'id' => '01942cf93310710d9faf4a4d76e05a9c',
                        'cmsPageId' => $cmsPageId,
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => false,
                        'type' => 'page',
                        'afterCategoryId' => '01942ce041de71cfbb175364b166dd4d',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '页脚服务导航',
                            'en-GB' => 'Footer service navigation',
                        ]),
                        'serviceSalesChannels' => [
                            [
                                'id' => $this->getStorefrontSalesChannel(),
                            ],
                        ],
                        'children' => [
                            [
                                'id' => '01942cf99e0e713ea31d4fdfe5b385bd',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'zh-CN' => '条款与条件',
                                    'en-GB' => 'Terms & Conditions',
                                ]),
                            ],
                            [
                                'id' => '01942cfb468c735293b76d34314c909e',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'afterCategoryId' => '01942cf99e0e713ea31d4fdfe5b385bd',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'zh-CN' => '隐私协议',
                                    'en-GB' => 'Privacy',
                                ]),
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function install(): void
    {
        $context = $this->installContext->getContext();
        $this->categoryRepository->upsert($this->getPayload(), $context);
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
        $this->categoryRepository->upsert([
            [
                'id' => $this->getRootCategoryId(),
                'cmsPageId' => null,
            ],
        ], $context);

        $this->salesChannelRepository->upsert([
            [
                'id' => $this->getStorefrontSalesChannel(),
                'footerCategoryId' => null,
                'serviceCategoryId' => null,
            ],
        ], $context);

        $this->deleteOnlyChildren($this->getRootCategoryId(), $context);
    }

    public function activate(): void
    {
    }

    public function deactivate(): void
    {
    }

    public function deleteOnlyChildren(string $parentCategoryId, Context $context): void
    {
        $childIds = $this->getAllChildCategoryIds($parentCategoryId, $context);

        if (\count($childIds) === 0) {
            return;
        }

        $deletePayload = array_map(fn ($id) => ['id' => $id], $childIds);

        $this->categoryRepository->delete($deletePayload, $context);
    }

    /**
     * @return list<string>
     */
    private function getAllChildCategoryIds(string $parentId, Context $context): array
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('parentId', $parentId));
        $criteria->addAssociation('children');

        $children = $this->categoryRepository->search($criteria, $context)->getEntities();

        $ids = [];
        foreach ($children as $child) {
            $ids[] = $child->getId();
            $ids = array_merge($ids, $this->getAllChildCategoryIds($child->getId(), $context));
        }

        return $ids;
    }

    private function getStorefrontSalesChannel(): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`id`))
            FROM `sales_channel`
            WHERE `type_id` = :storefront_type
        ', ['storefront_type' => Uuid::fromHexToBytes(Defaults::SALES_CHANNEL_TYPE_STOREFRONT)]);

        if ($result === false) {
            throw new \RuntimeException('No tax found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }

    private function getRootCategoryId(): string
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('parentId', null));

        $rootCategory = $this->categoryRepository->search($criteria, new Context(new SystemSource()))->getEntities()->first();
        if ($rootCategory === null) {
            throw new \RuntimeException('Root category not found');
        }

        return $rootCategory->getId();
    }

    private function getDefaultCmsListingPageId(): string
    {
        $id = $this->getCmsPageIdByName('Default listing layout');

        if ($id !== null) {
            return $id;
        }

        // BC support for older shopware versions - \Shopware\Core\Migration\V6_4\Migration1645019769UpdateCmsPageTranslation changed the translations
        $id = $this->getCmsPageIdByName('Default category layout');

        if ($id !== null) {
            return $id;
        }

        throw new \RuntimeException('Default Cms Listing page not found');
    }

    private function getCmsPageIdByName(string $name): ?string
    {
        $id = $this->connection->fetchOne(
            '
                SELECT LOWER(HEX(cms_page_id)) as cms_page_id
                FROM cms_page_translation
                INNER JOIN cms_page ON cms_page.id = cms_page_translation.cms_page_id
                WHERE cms_page.locked
                AND name = :name
            ',
            ['name' => $name],
        );

        return $id !== false ? $id : null;
    }
}
