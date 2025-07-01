<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap\Category;

use Hey\PlatformDemoData\Helper\TranslationHelper;

/**
 * @internal
 */
class AudioCategoryL2
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
                'id' => '01969f66e87472a0b723325442f83b62',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '无线耳机',
                    'en-GB' => 'Wireless Headphones',
                ]),
            ],
            [
                'id' => '01969f6812fc715692b5018d4f3731cd',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f66e87472a0b723325442f83b62',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '有线耳机',
                    'en-GB' => 'Wired Headphones',
                ]),
            ],
            [
                'id' => '01969f6abe847119a007b5438227a780',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f6812fc715692b5018d4f3731cd',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '降噪耳机',
                    'en-GB' => 'Noise-Cancelling Headphones',
                ]),
            ],
            [
                'id' => '01969f6b2e83700c85d3812750ffccf4',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f6abe847119a007b5438227a780',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '入耳式耳机',
                    'en-GB' => 'In-Ear Headphones',
                ]),
            ],
            [
                'id' => '01969f6b8de272079a75c4abc7d81464',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f6b2e83700c85d3812750ffccf4',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '游戏耳机',
                    'en-GB' => 'Gaming Headsets',
                ]),
            ],
            [
                'id' => '01969f6bf2af70028aa224fd1d28fa07',
                'cmsPageId' => $this->cmsPageId,
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'afterCategoryId' => '01969f6b8de272079a75c4abc7d81464',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '运动耳机',
                    'en-GB' => 'Sports Headphones',
                ]),
            ],
        ];
    }
}
