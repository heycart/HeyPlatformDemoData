<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use Hey\PlatformDemoData\Helper\TranslationHelper;
use HeyCart\Core\Checkout\Promotion\PromotionCollection;
use HeyCart\Core\Defaults;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;
use HeyCart\Core\Framework\Uuid\Uuid;

/**
 * @internal
 */
class PromotionBoostrap extends AbstractBootstrap
{
    private Connection $connection;

    private TranslationHelper $translationHelper;

    /**
     * @var EntityRepository<PromotionCollection>
     */
    private EntityRepository $promotionRepository;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->translationHelper = new TranslationHelper($this->connection);
        $this->promotionRepository = $this->container->get('promotion.repository');
    }

    public function install(): void
    {
        $context = $this->installContext->getContext();
        $this->promotionRepository->upsert($this->getPayload(), $context);
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

        $this->promotionRepository->delete($ids, $context);
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
                'id' => '01942d4fa1d57397aca1a47ad887f401',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '促销-1',
                    'en-GB' => 'promotion-1',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '100000000000',
                'salesChannels' => [
                    [
                        'id' => '01969fa0ce3b7612a136b7b0b7f9f6fe',
                        'priority' => 1,
                        'salesChannelId' => $this->getStorefrontSalesChannel(),
                    ],
                ],
                'useCodes' => true,
            ],
            [
                'id' => '01942d7f77f473f3b3daaa9d2d4f8339',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '年度大促',
                    'en-GB' => 'Annual Sale',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '120000000000',
                'useCodes' => true,
            ],
            [
                'id' => '01942d8047127270989973cf41cc79c4',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '限时闪购',
                    'en-GB' => 'Flash Sale',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130000000000',
                'useCodes' => true,
            ],
            [
                'id' => '01942d8047127270989973cf41cc79c4',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '狂欢购物节',
                    'en-GB' => 'Shopping Festival',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000000',
                'useCodes' => true,
            ],
            [
                'id' => '01942d8118597099840cfc5a240d6656',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '双倍积分周',
                    'en-GB' => 'Double Points Week',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000001',
                'useCodes' => true,
            ],
            [
                'id' => '01942d8188a872568bd6269a08b94403',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '超值优惠',
                    'en-GB' => 'Super Value Deals',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000002',
                'useCodes' => true,
            ],
            [
                'id' => '01942d8230d7719ab02b584ed41d3688',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '新年狂欢',
                    'en-GB' => 'New Year Bonanza',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000003',
                'useCodes' => true,
            ],
            [
                'id' => '01942d828a3872b39c77b4b247ed45bb',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '黑五预热',
                    'en-GB' => 'Black Friday Preview',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000004',
                'useCodes' => true,
            ],
            [
                'id' => '01942d82eb0e704fadcd50b7c7b07e42',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '节日特惠',
                    'en-GB' => 'Holiday Special',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000005',
                'useCodes' => true,
            ],
            [
                'id' => '01942d834edd73249a5d2c53d3a97e9e',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '清仓大甩卖',
                    'en-GB' => 'Clearance Blowout',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000006',
                'useCodes' => true,
            ],
            [
                'id' => '01942d83ae247225910b189710cb561a',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '秋季大促',
                    'en-GB' => 'Fall Mega Sale',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000007',
                'useCodes' => true,
            ],
            [
                'id' => '01942d841c1d704e8a1a3ea6b2b29870',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '秋季大促',
                    'en-GB' => 'Fall Mega Sale',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000008',
                'useCodes' => true,
            ],
            [
                'id' => '01942d84612d7230a991164377780132',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '周末惊喜',
                    'en-GB' => 'Weekend Surprises',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000009',
                'useCodes' => true,
            ],
            [
                'id' => '01942d84c5ad70699e60da2e5348e3b4',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '购物满减',
                    'en-GB' => 'Spend and Save',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000010',
                'useCodes' => true,
            ],
            [
                'id' => '01942d8530bc724ebb8beb6300ef750e',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '会员专享',
                    'en-GB' => 'Members Exclusive',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000011',
                'useCodes' => true,
            ],
            [
                'id' => '01942d85897572c38174d1c095a4eea1',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '限量秒杀',
                    'en-GB' => 'Limited-Time Flash Deals',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000012',
                'useCodes' => true,
            ],
            [
                'id' => '01942d85d8c871e68f85b90b2e04b467',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '限时抢购',
                    'en-GB' => 'Limited Time Grab',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000013',
                'useCodes' => true,
            ],
            [
                'id' => '01942d8628a372a982ac34bae3da7952',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '换季大促',
                    'en-GB' => 'Seasonal Sale',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000014',
                'useCodes' => true,
            ],
            [
                'id' => '01942d867c837226a3d422c191d1a73c',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '买一送一',
                    'en-GB' => 'Buy One Get One Free',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000015',
                'useCodes' => true,
            ],
            [
                'id' => '01942d86e2d270be9f88f6894db94421',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '春季抢购季',
                    'en-GB' => 'Spring Sale Season',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000016',
                'useCodes' => true,
            ],
            [
                'id' => '01942d8743087297bb70275d2009bb37',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '年度回馈',
                    'en-GB' => 'Annual Thank You Sale',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000017',
                'useCodes' => true,
            ],
            [
                'id' => '01942d87a230736ba0b4eb84b0213e20',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '生产商狂欢',
                    'en-GB' => 'Brand Extravaganza',
                ]),
                'active' => true,
                'validFrom' => new \DateTime(),
                'validUntil' => (new \DateTime())->add(new \DateInterval('P365D')),
                'code' => '130010000018',
                'useCodes' => true,
            ],
        ];
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
}
