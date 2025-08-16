<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use Hey\PlatformDemoData\Helper\TranslationHelper;
use HeyCart\Core\Content\Product\Aggregate\ProductVisibility\ProductVisibilityDefinition;
use HeyCart\Core\Content\Product\ProductCollection;
use HeyCart\Core\Defaults;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;
use HeyCart\Core\Framework\Uuid\Uuid;

/**
 * @internal
 */
class ProductBoostrap extends AbstractBootstrap
{
    private const LOREM_IPSUM_EN = 'Unlocking new level of performance with whole-new P-core & E-core architecture bringing improved performance per watt, the Intel® Core™ Ultra 9 processor 285HX is here to make portable gaming cooler, quieter with elite-level performance.';
    private const LOREM_IPSUM_ZH = '全新的性能核（P-core）与能效核（E-core）架构释放全新性能水平，带来更高的每瓦性能表现。Intel® Core™ Ultra 9 处理器 285HX 现已登场，为便携式游戏带来更冷静、更安静的使用体验与精英级性能表现。';

    private Connection $connection;

    private TranslationHelper $translationHelper;

    /**
     * @var EntityRepository<ProductCollection>
     */
    private EntityRepository $productRepository;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->translationHelper = new TranslationHelper($this->connection);
        $this->productRepository = $this->container->get('product.repository');
    }

    public function install(): void
    {
        $context = $this->installContext->getContext();
        $this->productRepository->upsert($this->getPayload(), $context);
    }

    public function update(): void
    {
    }

    public function uninstall(bool $keepUserData = false): void
    {
        if ($keepUserData) {
            return;
        }
        $ids = array_map(function ($group) {
            return ['id' => $group['id']];
        }, $this->getPayload());
        $context = $this->installContext->getContext();
        $this->productRepository->delete($ids, $context);
    }

    public function activate(): void
    {
    }

    public function deactivate(): void
    {
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getPayload(): array
    {
        $storefrontSalesChannel = $this->getStorefrontSalesChannel();
        $taxId = $this->getTaxId();

        return [
            [
                'id' => '11dc680240b04f469ccba354cbf0b967',
                'productNumber' => 'SWDEMO10002',
                'active' => true,
                'taxId' => $taxId,
                'stock' => 10,
                'purchaseUnit' => 1.0,
                'referenceUnit' => 1.0,
                'shippingFree' => true,
                'purchasePrice' => 900,
                'weight' => 45.0,
                'width' => 590.0,
                'height' => 600.0,
                'length' => 840.0,
                'isCloseout' => true,
                'releaseDate' => new \DateTimeImmutable(),
                'displayInListing' => true,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '超级游戏笔记本电脑',
                    'en-GB' => 'High-end gaming laptop',
                ]),
                'description' => $this->translationHelper->adjustTranslations([
                    'en-GB' => self::LOREM_IPSUM_EN,
                    'zh-CN' => self::LOREM_IPSUM_ZH,
                ]),
                'media' => [
                    [
                        'id' => 'e648140ff1f04177b40128ac6b649d8a',
                        'position' => 1,
                        'mediaId' => '84356a71233d4b3e9f417dcc8850c82f',
                    ],
                ],
                'coverId' => 'e648140ff1f04177b40128ac6b649d8a',
                'categories' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                    ],
                ],
                'price' => [[
                    'net' => 798.3199999999999,
                    'gross' => 950,
                    'linked' => true,
                    'currencyId' => Defaults::CURRENCY,
                ]],
                'properties' => [
                    [
                        'id' => '2bfd278e87204807a890da4a3e81dd90',
                    ],
                    [
                        'id' => '52454db2adf942b2ac079a296f454a10',
                    ],
                ],
                'visibilities' => [
                    [
                        'id' => '69cd1be4be004944b923ddbe571e96f5',
                        'salesChannelId' => $storefrontSalesChannel,
                        'visibility' => ProductVisibilityDefinition::VISIBILITY_ALL,
                    ],
                ],
            ],
            [
                'id' => '01969ce27621706288b81b3f3d1db607',
                'productNumber' => '48961449940',
                'active' => true,
                'taxId' => $taxId,
                'stock' => 66,
                'purchaseUnit' => 1.0,
                'referenceUnit' => 1.0,
                'shippingFree' => true,
                'purchasePrice' => 950,
                'weight' => 45.0,
                'width' => 590.0,
                'height' => 600.0,
                'length' => 840.0,
                'releaseDate' => new \DateTimeImmutable(),
                'displayInListing' => true,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '高性能游戏笔记本',
                    'en-GB' => 'Raider 18 HX AI A2XWJG ( RTX5090 )',
                ]),
                'description' => $this->translationHelper->adjustTranslations([
                    'en-GB' => self::LOREM_IPSUM_EN,
                    'zh-CN' => self::LOREM_IPSUM_ZH,
                ]),
                'media' => [
                    [
                        'id' => '01969ce27621706288b81b3f3d1db607',
                        'position' => 1,
                        'mediaId' => '01969ce27621706288b81b3f3d1db607',
                    ],
                ],
                'coverId' => '01969ce27621706288b81b3f3d1db607',
                'categories' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                    ],
                ],
                'price' => [[
                    'net' => 120,
                    'gross' => 120,
                    'linked' => true,
                    'currencyId' => Defaults::CURRENCY,
                ]],
                'properties' => [
                    [
                        'id' => '01970d7fd3507299b87848ed0e4c5ff3',
                    ],
                    [
                        'id' => '54147692cbfb43419a6d11e26cad44dc',
                    ],
                ],
                'visibilities' => [
                    [
                        'id' => '01969ce27621706288b81b3f3d1db607',
                        'salesChannelId' => $storefrontSalesChannel,
                        'visibility' => ProductVisibilityDefinition::VISIBILITY_ALL,
                    ],
                ],
            ],
            [
                'id' => '01969ce6bfc17264ab7938fe729442cc',
                'productNumber' => '60604719228',
                'active' => true,
                'taxId' => $taxId,
                'stock' => 6130,
                'purchaseUnit' => 1.0,
                'referenceUnit' => 1.0,
                'shippingFree' => true,
                'purchasePrice' => 950,
                'weight' => 45.0,
                'width' => 580.0,
                'height' => 600.0,
                'length' => 810.0,
                'isCloseout' => true,
                'releaseDate' => new \DateTimeImmutable(),
                'displayInListing' => true,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '高性能影视剪辑笔记本A',
                    'en-GB' => 'Edition Norse Myth RTX5090',
                ]),
                'description' => $this->translationHelper->adjustTranslations([
                    'en-GB' => self::LOREM_IPSUM_EN,
                    'zh-CN' => self::LOREM_IPSUM_ZH,
                ]),
                'media' => [
                    [
                        'id' => '01969ce6bfc17264ab7938fe729442cc',
                        'position' => 1,
                        'mediaId' => '01969ce6bfc17264ab7938fe729442cc',
                    ],
                ],
                'coverId' => '01969ce6bfc17264ab7938fe729442cc',
                'categories' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                    ],
                ],
                'price' => [[
                    'net' => 59,
                    'gross' => 59,
                    'linked' => true,
                    'currencyId' => Defaults::CURRENCY,
                ]],
                'visibilities' => [
                    [
                        'id' => '01969ce6bfc17264ab7938fe729442cc',
                        'salesChannelId' => $storefrontSalesChannel,
                        'visibility' => ProductVisibilityDefinition::VISIBILITY_ALL,
                    ],
                ],
            ],
            [
                'id' => '019787a21bcf720594e1408a1d8361b2',
                'productNumber' => '943994754',
                'active' => true,
                'taxId' => $taxId,
                'stock' => 100,
                'purchaseUnit' => 1.0,
                'referenceUnit' => 1.0,
                'shippingFree' => true,
                'purchasePrice' => 950,
                'weight' => 45.0,
                'width' => 580.0,
                'height' => 600.0,
                'length' => 810.0,
                'isCloseout' => true,
                'releaseDate' => new \DateTimeImmutable(),
                'displayInListing' => true,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '笔记本 (变体产品)',
                    'en-GB' => 'Desktop-Level Performance (Variant product)',
                ]),
                'description' => $this->translationHelper->adjustTranslations([
                    'en-GB' => self::LOREM_IPSUM_EN,
                    'zh-CN' => self::LOREM_IPSUM_ZH,
                ]),
                'media' => [
                    [
                        'id' => '019787a21bcf720594e1408a1d8361b2',
                        'position' => 1,
                        'mediaId' => '019787a21bcf720594e1408a1d8361b2',
                    ],
                ],
                'coverId' => '019787a21bcf720594e1408a1d8361b2',
                'categories' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                    ],
                ],
                'price' => [[
                    'net' => 600,
                    'gross' => 600,
                    'linked' => true,
                    'currencyId' => Defaults::CURRENCY,
                ]],
                'visibilities' => [
                    [
                        'id' => '019787a21bcf720594e1408a1d8361b2',
                        'salesChannelId' => $storefrontSalesChannel,
                        'visibility' => ProductVisibilityDefinition::VISIBILITY_ALL,
                    ],
                ],
                'configuratorSettings' => [
                    [
                        'optionId' => '7cab88165ae5420f921232511b6e8f7d',
                    ],
                    [
                        'optionId' => '78c53f3f6dd14eb4927978415bfb74db',
                    ],
                    [
                        'optionId' => '22bdaee755804c1d8099c0d3696e852c',
                    ],
                ],
                'children' => [
                    [
                        'productNumber' => 'SWDEMO10005943994754.1',
                        'stock' => 50,
                        'options' => [
                            [
                                'id' => '78c53f3f6dd14eb4927978415bfb74db',
                            ],
                            [
                                'id' => '7cab88165ae5420f921232511b6e8f7d',
                            ],
                            [
                                'id' => '6f9359239c994b48b7de282ee19a714d',
                            ],
                            [
                                'id' => '01969f947a727360a1d8f54b422ec287',
                            ],
                        ],
                    ],
                    [
                        'productNumber' => 'SWDEMO10005943994754.2',
                        'stock' => 50,
                        'options' => [
                            [
                                'id' => '22bdaee755804c1d8099c0d3696e852c',
                            ],
                            [
                                'id' => '327d6c0b12264d7bb479ee18eb66ab23',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id' => '019787c4feab7373994867e7a55896b5',
                'productNumber' => 'SWDEMO10002830754918',
                'active' => true,
                'taxId' => $taxId,
                'stock' => 10,
                'purchaseUnit' => 1.0,
                'referenceUnit' => 1.0,
                'shippingFree' => true,
                'purchasePrice' => 950,
                'weight' => 45.0,
                'width' => 590.0,
                'height' => 600.0,
                'length' => 840.0,
                'releaseDate' => new \DateTimeImmutable(),
                'displayInListing' => true,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '主打产品及其高级定价',
                    'en-GB' => 'Main product with advanced prices',
                ]),
                'description' => $this->translationHelper->adjustTranslations([
                    'en-GB' => self::LOREM_IPSUM_EN,
                    'zh-CN' => self::LOREM_IPSUM_ZH,
                ]),
                'manufacturer' => [
                    'id' => '019787c4feab7373994867e7a55896b5',
                    'name' => $this->translationHelper->adjustTranslations([
                        'zh-CN' => 'AllinCart 技术部',
                        'en-GB' => 'AllinCart Technology Department',
                    ]),
                ],
                'media' => [
                    [
                        'id' => '019787c4feab7373994867e7a55896b5',
                        'position' => 1,
                        'mediaId' => '019787c4feab7373994867e7a55896b5',
                    ],
                ],
                'coverId' => '019787c4feab7373994867e7a55896b5',
                'categories' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                    ],
                ],
                'price' => [[
                    'net' => 950,
                    'gross' => 950,
                    'linked' => true,
                    'currencyId' => Defaults::CURRENCY,
                ]],
                'prices' => [
                    [
                        'ruleId' => '28caae75a5624f0d985abd0eb32aa160',
                        'price' => [[
                            'net' => 500,
                            'gross' => 500,
                            'linked' => true,
                            'currencyId' => Defaults::CURRENCY,
                        ]],
                        'quantityStart' => 12,
                        'quantityEnd' => null,
                    ],
                    [
                        'ruleId' => '28caae75a5624f0d985abd0eb32aa160',
                        'price' => [[
                            'net' => 800,
                            'gross' => 800,
                            'linked' => true,
                            'currencyId' => Defaults::CURRENCY,
                        ]],
                        'quantityStart' => 1,
                        'quantityEnd' => 11,
                    ],
                ],
                'visibilities' => [
                    [
                        'id' => '019787c4feab7373994867e7a55896b5',
                        'salesChannelId' => $storefrontSalesChannel,
                        'visibility' => ProductVisibilityDefinition::VISIBILITY_ALL,
                    ],
                ],
            ],
            [
                'id' => '019787c7d22b71de80037e5629f2536c',
                'productNumber' => 'SWDEMO100051750329709',
                'active' => true,
                'taxId' => $taxId,
                'stock' => 50,
                'purchaseUnit' => 1.0,
                'referenceUnit' => 1.0,
                'shippingFree' => true,
                'purchasePrice' => 19.99,
                'weight' => 0.5,
                'releaseDate' => new \DateTimeImmutable(),
                'displayInListing' => true,
                'name' => $this->translationHelper->adjustTranslations([
                    'en-GB' => 'Variant product',
                    'zh-CN' => '变体产品',
                ]),
                'description' => $this->translationHelper->adjustTranslations([
                    'en-GB' => self::LOREM_IPSUM_EN,
                    'zh-CN' => self::LOREM_IPSUM_ZH,
                ]),
                'media' => [
                    [
                        'id' => '019787c7d22b71de80037e5629f2536c',
                        'position' => 1,
                        'mediaId' => '019787c7d22b71de80037e5629f2536c',
                    ],
                ],
                'coverId' => '019787c7d22b71de80037e5629f2536c',
                'categories' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                    ],
                ],
                'price' => [[
                    'net' => 19.99,
                    'gross' => 19.99,
                    'linked' => true,
                    'currencyId' => Defaults::CURRENCY,
                ]],
                'visibilities' => [
                    [
                        'id' => '019787c7d22b71de80037e5629f2536c',
                        'salesChannelId' => $storefrontSalesChannel,
                        'visibility' => ProductVisibilityDefinition::VISIBILITY_ALL,
                    ],
                ],
                'properties' => [
                    [
                        'id' => '41e5013b67d64d3a92b7a275da8af441',
                    ],
                    [
                        'id' => '327d6c0b12264d7bb479ee18eb66ab23',
                    ],
                    [
                        'id' => '01970d7f93a972ad8770a96ac57d1a81',
                    ],
                ],
                'configuratorSettings' => [
                    [
                        'optionId' => '2bfd278e87204807a890da4a3e81dd90',
                        'mediaId' => '019787cfd2be71278f4db3a453a280bf',
                    ],
                    [
                        'optionId' => '22bdaee755804c1d8099c0d3696e852c',
                    ],
                    [
                        'optionId' => '327d6c0b12264d7bb479ee18eb66ab23',
                    ],
                    [
                        'optionId' => '34066fc5b043464caaaca5b1ec5aa233',
                    ],
                    [
                        'optionId' => '52454db2adf942b2ac079a296f454a10',
                        'mediaId' => '019787d0c21172109a1dfe3ba67e9270',
                    ],
                    [
                        'optionId' => 'ad735af1ebfb421e93e408b073c4a89a',
                        'mediaId' => '019787d18d2b71d68f62fd7fc06bd86c',
                    ],
                ],
                'children' => [
                    [
                        'productNumber' => 'SWDEMO100051750329709.1',
                        'stock' => 50,
                        'options' => [
                            [
                                'id' => '2bfd278e87204807a890da4a3e81dd90',
                            ],
                            [
                                'id' => '22bdaee755804c1d8099c0d3696e852c',
                            ],
                        ],
                    ],
                    [
                        'productNumber' => 'SWDEMO100051750329709.2',
                        'stock' => 50,
                        'options' => [
                            [
                                'id' => '2bfd278e87204807a890da4a3e81dd90',
                            ],
                            [
                                'id' => '327d6c0b12264d7bb479ee18eb66ab23',
                            ],
                        ],
                    ],
                    [
                        'productNumber' => 'SWDEMO100051750329709.3',
                        'stock' => 50,
                        'options' => [
                            [
                                'id' => '2bfd278e87204807a890da4a3e81dd90',
                            ],
                            [
                                'id' => '34066fc5b043464caaaca5b1ec5aa233',
                            ],
                        ],
                    ],
                    [
                        'productNumber' => 'SWDEMO100051750329709.4',
                        'stock' => 50,
                        'options' => [
                            [
                                'id' => '52454db2adf942b2ac079a296f454a10',
                            ],
                            [
                                'id' => '22bdaee755804c1d8099c0d3696e852c',
                            ],
                        ],
                    ],
                    [
                        'productNumber' => 'SWDEMO100051750329709.5',
                        'stock' => 50,
                        'options' => [
                            [
                                'id' => '52454db2adf942b2ac079a296f454a10',
                            ],
                            [
                                'id' => '327d6c0b12264d7bb479ee18eb66ab23',
                            ],
                        ],
                    ],
                    [
                        'productNumber' => 'SWDEMO100051750329709.6',
                        'stock' => 50,
                        'options' => [
                            [
                                'id' => '52454db2adf942b2ac079a296f454a10',
                            ],
                            [
                                'id' => '34066fc5b043464caaaca5b1ec5aa233',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    private function getTaxId(): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(COALESCE(
                (SELECT `id` FROM `tax` WHERE tax_rate = "19.00" LIMIT 1),
	            (SELECT `id` FROM `tax`  LIMIT 1)
            )))
        ');

        if (!$result) {
            throw new \RuntimeException('No tax found, please make sure that basic data is available by running the migrations.');
        }

        return (string)$result;
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

        return (string)$result;
    }
}
