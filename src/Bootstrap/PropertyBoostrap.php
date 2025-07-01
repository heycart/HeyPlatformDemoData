<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use Hey\PlatformDemoData\Helper\TranslationHelper;
use HeyCart\Core\Content\Property\PropertyGroupCollection;
use HeyCart\Core\Content\Property\PropertyGroupDefinition;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;

/**
 * @internal
 */
class PropertyBoostrap extends AbstractBootstrap
{
    private TranslationHelper $translationHelper;

    private Connection $connection;

    /**
     * @var EntityRepository<PropertyGroupCollection>
     */
    private EntityRepository $propertyGroupRepository;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->translationHelper = new TranslationHelper($this->connection);
        $this->propertyGroupRepository = $this->container->get('property_group.repository');
    }

    public function install(): void
    {
        $context = $this->installContext->getContext();
        $this->propertyGroupRepository->upsert($this->getPayload(), $context);
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

        $this->propertyGroupRepository->delete($ids, $context);
    }

    public function activate(): void
    {
        // TODO: Implement activate() method.
    }

    public function deactivate(): void
    {
        // TODO: Implement deactivate() method.
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getPayload(): array
    {
        return [
            [
                'id' => '1857bb30fe6448c88f8ad331cf6dfa0c',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_TEXT,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '存储容量',
                    'en-GB' => 'Storage',
                ]),
                'options' => [
                    [
                        'id' => '78c53f3f6dd14eb4927978415bfb74db',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '64GB',
                            'en-GB' => '64GB',
                        ]),
                    ],
                    [
                        'id' => '7cab88165ae5420f921232511b6e8f7d',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '128GB',
                            'en-GB' => '128GB',
                        ]),
                    ],
                    [
                        'id' => '6f9359239c994b48b7de282ee19a714d',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '256GB',
                            'en-GB' => '256GB',
                        ]),
                    ],
                    [
                        'id' => '01969f947a727360a1d8f54b422ec287',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '512GB',
                            'en-GB' => '512GB',
                        ]),
                    ],
                ],
            ],
            [
                'id' => '269c7e40a54a462e884edb004c5f7bc8',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_COLOR,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '颜色',
                    'en-GB' => 'Colour',
                ]),
                'options' => [
                    [
                        'id' => '2bfd278e87204807a890da4a3e81dd90',
                        'colorHexCode' => '#0000ffff',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '蓝色',
                            'en-GB' => 'Blue',
                        ]),
                    ],
                    [
                        'id' => '52454db2adf942b2ac079a296f454a10',
                        'colorHexCode' => '#ff0000ff',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '红色',
                            'en-GB' => 'Red',
                        ]),
                    ],
                    [
                        'id' => 'ad735af1ebfb421e93e408b073c4a89a',
                        'colorHexCode' => '#ffffffff',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '白色',
                            'en-GB' => 'White',
                        ]),
                    ],
                ],
            ],
            [
                'id' => '448f3d72803f4ac8afc0c1108739ddf4',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_TEXT,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '内存',
                    'en-GB' => 'RAM',
                ]),
                'options' => [
                    [
                        'id' => '22bdaee755804c1d8099c0d3696e852c',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '4GB',
                            'en-GB' => '4GB',
                        ]),
                    ],
                    [
                        'id' => '327d6c0b12264d7bb479ee18eb66ab23',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '8GB',
                            'en-GB' => '8GB',
                        ]),
                    ],
                    [
                        'id' => '34066fc5b043464caaaca5b1ec5aa233',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '12GB',
                            'en-GB' => '12GB',
                        ]),
                    ],
                ],
            ],
            [
                'id' => '75f353b589d04bf48e8a9ab1f5422b0e',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_TEXT,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '电池容量',
                    'en-GB' => 'Battery Capacity',
                ]),
                'options' => [
                    [
                        'id' => '41e5013b67d64d3a92b7a275da8af441',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '3000mAh',
                            'en-GB' => '3000mAh',
                        ]),
                    ],
                    [
                        'id' => '5997d91dc0784997bdef68dfc5a08912',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '5000mAh',
                            'en-GB' => '5000mAh',
                        ]),
                    ],
                    [
                        'id' => '54147692cbfb43419a6d11e26cad44dc',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '6000mAh',
                            'en-GB' => '6000mAh',
                        ]),
                    ],
                ],
            ],
            [
                'id' => '01970d7f510f735b9a70eec691f238cc',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_TEXT,
                'name' => $this->translationHelper->adjustTranslations([
                    'en-GB' => 'Resolution',
                    'zh-CN' => '分辨率',
                ]),
                'options' => [
                    [
                        'id' => '01970d7f93a972ad8770a96ac57d1a81',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '1280 × 720',
                            'en-GB' => '1280 × 720',
                        ]),
                    ],
                    [
                        'id' => '01970d7fd3507299b87848ed0e4c5ff3',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '1920 × 1080',
                            'en-GB' => '1920 × 1080',
                        ]),
                    ],
                    [
                        'id' => '01970d800dd6703090ce77d9a4bc1e47',
                        'name' => $this->translationHelper->adjustTranslations([
                            'zh-CN' => '3840 × 2160',
                            'en-GB' => '3840 × 2160',
                        ]),
                    ],
                ],
            ],
        ];
    }
}
