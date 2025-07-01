<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use Hey\PlatformDemoData\Helper\TranslationHelper;
use HeyCart\Core\Content\Cms\CmsPageCollection;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;

/**
 * @internal
 */
class CmsPageBoostrap extends AbstractBootstrap
{
    private TranslationHelper $translationHelper;

    private Connection $connection;

    /**
     * @var EntityRepository<CmsPageCollection>
     */
    private EntityRepository $cmsPageRepository;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->translationHelper = new TranslationHelper($this->connection);
        $this->cmsPageRepository = $this->container->get('cms_page.repository');
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getPayload(): array
    {
        return [
            [
                'id' => '695477e02ef643e5a016b83ed4cdf63a',
                'type' => 'landingpage',
                'locked' => 0,
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '首页',
                    'en-GB' => 'Homepage',
                ]),
                'sections' => [
                    [
                        'id' => '935477e02ef643e5a016b83ed4cdf63a',
                        'backgroundMediaMode' => 'cover',
                        'type' => 'default',
                        'position' => 0,
                        'blocks' => [
                            [
                                'id' => '01942cabd4d1701eb123bebacb491268',
                                'position' => 0,
                                'type' => 'text-on-image',
                                'sectionPosition' => 'main',
                                'marginLeft' => '0',
                                'marginRight' => '0',
                                'backgroundMediaMode' => 'cover',
                                'backgroundMediaId' => 'de4b7dbe9d95435092cb85ce146ced28',
                                'slots' => [
                                    [
                                        'id' => '9e2f55fac84647098fe5b0f17ee4786f',
                                        'type' => 'text',
                                        'slot' => 'content',
                                        'translations' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => [
                                                'config' => [
                                                    'content' => [
                                                        'source' => 'static',
                                                        'value' => '<h2 style="text-align: center; color: #FFFFFF">Lorem Ipsum</h2>
                        <p style="text-align: center; color: #FFFFFF">Lorem ipsum dolor sit amet, consetetur
                        sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                        lorem ipsum dolor sit amet.</p>',
                                                    ],
                                                    'verticalAlign' => [
                                                        'value' => null,
                                                        'source' => 'static',
                                                    ],
                                                ],
                                            ],
                                            'en-GB' => [
                                                'config' => [
                                                    'content' => [
                                                        'source' => 'static',
                                                        'value' => '<h2 style="text-align: center; color: #FFFFFF">Lorem Ipsum</h2>
                        <p style="text-align: center; color: #FFFFFF">Lorem ipsum dolor sit amet, consetetur
                        sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                        lorem ipsum dolor sit amet.</p>',
                                                    ],
                                                    'verticalAlign' => [
                                                        'value' => null,
                                                        'source' => 'static',
                                                    ],
                                                ],
                                            ],
                                        ]),
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'id' => '01942cbac1fd7f118ce5ebb900f3a223',
                        'type' => 'default',
                        'position' => 1,
                        'cssClass' => 'mt-2',
                        'blocks' => [
                            [
                                'id' => '01969eb64cdb7083b7a5a8a28d645eea',
                                'position' => 0,
                                'type' => 'text-teaser',
                                'sectionPosition' => 'main',
                                'marginTop' => '20px',
                                'marginBottom' => '20px',
                                'backgroundMediaMode' => 'cover',
                                'visibility' => [
                                    'desktop' => true,
                                    'tablet' => true,
                                    'mobile' => true,
                                ],
                                'slots' => [
                                    [
                                        'id' => '01969eb8d4d47279a2d3627743ba4016',
                                        'type' => 'text',
                                        'slot' => 'content',
                                        'translations' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => [
                                                'config' => [
                                                    'content' => [
                                                        'source' => 'static',
                                                        'value' => '<h2 style="text-align: center; color: #000000">热销商品</h2>
                                                            <p style="text-align: center; color: #000000">这些是目前最受欢迎的产品，深受用户喜爱，销量持续攀升。无论是品质、价格，还是实用性，都经过市场检验，是众多买家的优选之选。限时优惠、库存有限，赶快下单，不容错过！</p>',
                                                    ],
                                                    'verticalAlign' => [
                                                        'value' => null,
                                                        'source' => 'static',
                                                    ],
                                                ],
                                            ],
                                            'en-GB' => [
                                                'config' => [
                                                    'content' => [
                                                        'source' => 'static',
                                                        'value' => '<h2 style="text-align: center; color: #000000">Hot Sale Products</h2>
                                                            <p style="text-align: center; color: #000000">These are our most popular products, loved by customers and climbing in sales. Whether it\'s quality, price, or practicality, they\'ve been tested by the market and chosen by countless buyers. Limited-time offers and low stock — order now before it\'s gone!</p>',
                                                    ],
                                                    'verticalAlign' => [
                                                        'value' => null,
                                                        'source' => 'static',
                                                    ],
                                                ],
                                            ],
                                        ]),
                                    ],
                                ],
                            ],
                            [
                                'id' => '01942cbbd2a0713b858d87beb17c3db9',
                                'position' => 1,
                                'type' => 'product-three-column',
                                'sectionPosition' => 'main',
                                'marginLeft' => '0',
                                'marginRight' => '0',
                                'backgroundMediaMode' => 'cover',
                                'slots' => [
                                    [
                                        'id' => '01942cbbd2a0713b858d87bfcfbbe1c7',
                                        'type' => 'product-box',
                                        'slot' => 'left',
                                        'translations' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => [
                                                'config' => [
                                                    'product' => [
                                                        'source' => 'static',
                                                        'value' => '11dc680240b04f469ccba354cbf0b967',
                                                    ],
                                                    'boxLayout' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'displayMode' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'verticalAlign' => [
                                                        'source' => 'static',
                                                        'value' => null,
                                                    ],
                                                ],
                                            ],
                                            'en-GB' => [
                                                'config' => [
                                                    'product' => [
                                                        'source' => 'static',
                                                        'value' => '11dc680240b04f469ccba354cbf0b967',
                                                    ],
                                                    'boxLayout' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'displayMode' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'verticalAlign' => [
                                                        'source' => 'static',
                                                        'value' => null,
                                                    ],
                                                ],
                                            ],
                                        ]),
                                    ],
                                    [
                                        'id' => '01942cbbd2a0713b858d87c0e78dc8dc',
                                        'type' => 'product-box',
                                        'slot' => 'center',
                                        'translations' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => [
                                                'config' => [
                                                    'product' => [
                                                        'source' => 'static',
                                                        'value' => '01969ce27621706288b81b3f3d1db607',
                                                    ],
                                                    'boxLayout' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'displayMode' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'verticalAlign' => [
                                                        'source' => 'static',
                                                        'value' => null,
                                                    ],
                                                ],
                                            ],
                                            'en-GB' => [
                                                'config' => [
                                                    'product' => [
                                                        'source' => 'static',
                                                        'value' => '01969ce27621706288b81b3f3d1db607',
                                                    ],
                                                    'boxLayout' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'displayMode' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'verticalAlign' => [
                                                        'source' => 'static',
                                                        'value' => null,
                                                    ],
                                                ],
                                            ],
                                        ]),
                                    ],
                                    [
                                        'id' => '01942cbbd2a0713b858d87c197fb500c',
                                        'type' => 'product-box',
                                        'slot' => 'right',
                                        'translations' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => [
                                                'config' => [
                                                    'product' => [
                                                        'source' => 'static',
                                                        'value' => '01969ce6bfc17264ab7938fe729442cc',
                                                    ],
                                                    'boxLayout' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'displayMode' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'verticalAlign' => [
                                                        'source' => 'static',
                                                        'value' => null,
                                                    ],
                                                ],
                                            ],
                                            'en-GB' => [
                                                'config' => [
                                                    'product' => [
                                                        'source' => 'static',
                                                        'value' => '01969ce6bfc17264ab7938fe729442cc',
                                                    ],
                                                    'boxLayout' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'displayMode' => [
                                                        'source' => 'static',
                                                        'value' => 'standard',
                                                    ],
                                                    'verticalAlign' => [
                                                        'source' => 'static',
                                                        'value' => null,
                                                    ],
                                                ],
                                            ],
                                        ]),
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'id' => '01969ed3a8597398b62865646c9949fe',
                        'backgroundMediaMode' => 'cover',
                        'position' => 3,
                        'type' => 'default',
                        'blocks' => [
                            [
                                'id' => '01969ed4b17b70349930234d7fe7964d',
                                'position' => 0,
                                'type' => 'text-hero',
                                'marginTop' => '20px',
                                'marginBottom' => '20px',
                                'backgroundMediaMode' => 'cover',
                                'slots' => [
                                    [
                                        'id' => '01969ed5d05d73049878d3f8ca023f32',
                                        'type' => 'text',
                                        'slot' => 'content',
                                        'translations' => $this->translationHelper->adjustTranslations([
                                            'zh-CN' => [
                                                'config' => [
                                                    'content' => [
                                                        'source' => 'static',
                                                        'value' => '<h2 style="text-align: center;">特价商品</h2><hr><p style="text-align: center;">限时特惠，超值精选！这些商品经过精挑细选，现正以优惠价格限时发售。不论是自用还是送礼，都是省钱又实用的好选择，机会难得，赶快抢购！</p>',
                                                    ],
                                                ],
                                            ],
                                            'en-GB' => [
                                                'config' => [
                                                    'content' => [
                                                        'source' => 'static',
                                                        'value' => '<h2 style="text-align: center;">Special discounts, great value!</h2><hr><p style="text-align: center;">These hand-picked items are now available at limited-time prices. Whether for yourself or as a gift, they offer quality and savings in one — don’t miss out on this great deal!</p>',
                                                    ],
                                                ],
                                            ],
                                        ]),
                                    ],
                                ],
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
        $this->cmsPageRepository->upsert($this->getPayload(), $context);
    }

    public function update(): void
    {
    }

    public function uninstall(bool $keepUserData = false): void
    {
        if ($keepUserData) {
            return;
        }

        $context = $this->installContext->getContext();
        $this->cmsPageRepository->delete([
            [
                'id' => '695477e02ef643e5a016b83ed4cdf63a',
            ],
        ], $context);
    }

    public function activate(): void
    {
    }

    public function deactivate(): void
    {
    }
}
