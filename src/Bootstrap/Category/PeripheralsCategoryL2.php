<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap\Category;

use Hey\PlatformDemoData\Helper\TranslationHelper;

/**
 * @internal
 */
class PeripheralsCategoryL2
{
    public function __construct(
        private string $cmsPageId,
        private readonly TranslationHelper $translationHelper,
    ) {
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getPayload(): array
    {
        return [
            [
                'id' => '01969f7aae40704d85cc3f69e5f38046',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '鼠标',
                    'en-GB' => 'Mouse',
                ]),
            ],
            [
                'id' => '01969f7aedc5706cbfffd044a8253b20',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7aae40704d85cc3f69e5f38046',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '键盘',
                    'en-GB' => 'Keyboard',
                ]),
            ],
            [
                'id' => '01969f7b2fe4724980c08b70e040c2b5',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7aedc5706cbfffd044a8253b20',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '鼠标垫',
                    'en-GB' => 'Mouse Pads',
                ]),
            ],
            [
                'id' => '01969f7b8b1673a1a5c55110ad9dc22f',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7b2fe4724980c08b70e040c2b5',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '游戏外设',
                    'en-GB' => 'Gaming Peripherals',
                ]),
            ],
            [
                'id' => '01969f7bdef9707499e2727d1fd6d676',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7b8b1673a1a5c55110ad9dc22f',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '摄像头',
                    'en-GB' => 'Webcams',
                ]),
            ],
            [
                'id' => '01969f7c272a7171825182a518fcb3fe',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7bdef9707499e2727d1fd6d676',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '麦克风',
                    'en-GB' => 'Microphones',
                ]),
            ],
            [
                'id' => '01969f7c7e9372c39fd59fd92166a873',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7c272a7171825182a518fcb3fe',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '打印机',
                    'en-GB' => 'Printers',
                ]),
            ],
            [
                'id' => '01969f7cd03473fa86461af41b514d07',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7c7e9372c39fd59fd92166a873',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '扫描仪',
                    'en-GB' => 'Scanners',
                ]),
            ],
            [
                'id' => '01969f7d4e727380b98a3481f00251e0',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7cd03473fa86461af41b514d07',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '移动固态硬盘',
                    'en-GB' => 'External SSDs',
                ]),
            ],
            [
                'id' => '01969f7da4db7345b5236da96cd69df3',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f7d4e727380b98a3481f00251e0',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => 'U盘',
                    'en-GB' => 'USB Flash Drives',
                ]),
            ],
        ];
    }
}
