<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap\Category;

use Hey\PlatformDemoData\Helper\TranslationHelper;

/**
 * @internal
 */
class ComputersCategoryL2
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
                'id' => '01969f6f26627007a9ea40de2a0ad175',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '笔记本电脑',
                    'en-GB' => 'Laptops',
                ]),
            ],
            [
                'id' => '01969f6f6ca9722599fda702d65a5d03',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f6f26627007a9ea40de2a0ad175',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '台式电脑',
                    'en-GB' => 'Desktop PCs',
                ]),
            ],
            [
                'id' => '01969f6fb039700aa7cdcc9d9b04489b',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f6f6ca9722599fda702d65a5d03',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '平板电脑',
                    'en-GB' => 'Tablets',
                ]),
            ],
            [
                'id' => '01969f6ff8447054bff497218cf1b332',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f6fb039700aa7cdcc9d9b04489b',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => 'DIY 组装机',
                    'en-GB' => 'DIY / Custom-Built PCs',
                ]),
            ],
            [
                'id' => '01969f704ba472e7b1c06ce163611983',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f6ff8447054bff497218cf1b332',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '电脑配件',
                    'en-GB' => 'Computer Accessories',
                ]),
            ],
            [
                'id' => '01969f70a53c718e95875dc8cf8ad421',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f704ba472e7b1c06ce163611983',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '散热设备',
                    'en-GB' => 'Cooling Devices / Fans',
                ]),
            ],
        ];
    }
}
