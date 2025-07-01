<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use Hey\PlatformDemoData\Helper\DbHelper;
use HeyCart\Core\Defaults;
use HeyCart\Core\DevOps\Environment\EnvironmentHelper;
use HeyCart\Core\Framework\Api\Context\SystemSource;
use HeyCart\Core\Framework\Context;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;
use HeyCart\Core\Framework\DataAbstractionLayer\Search\Criteria;
use HeyCart\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use HeyCart\Core\Framework\Uuid\Uuid;
use HeyCart\Core\System\SalesChannel\Aggregate\SalesChannelDomain\SalesChannelDomainCollection;

/**
 * @internal
 */
class DomainBoostrap extends AbstractBootstrap
{
    private Connection $connection;

    private DbHelper $dbHelper;

    /**
     * @var EntityRepository<SalesChannelDomainCollection>
     */
    private EntityRepository $salesChannelDomainRepository;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->dbHelper = new DbHelper($this->connection);
        $this->salesChannelDomainRepository = $this->container->get('sales_channel_domain.repository');
    }

    public function install(): void
    {
        $salesChannelId = $this->getStorefrontSalesChannel();
        $context = new Context(new SystemSource());
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('salesChannelId', $salesChannelId));
        /** @var SalesChannelDomainCollection $domains */
        $domains = $this->salesChannelDomainRepository->search($criteria, $context)->getEntities();

        if (\count($domains) === 0) {
            return;
        }

        $englishId = $this->dbHelper->getLanguageId('en-GB');
        $chineseId = $this->dbHelper->getLanguageId('zh-CN');

        $enSnippetSetId = $this->getSnippetSetId('en-GB');
        $zhSnippetSetId = $this->getSnippetSetId('zh-CN');

        $appUrl = EnvironmentHelper::getVariable('APP_URL', 'http://localhost');

        $newDomainData = null;

        if ($enSnippetSetId !== null && $domains->filterByProperty('snippetSetId', $enSnippetSetId)->count() === 0) {
            $newDomainData = [
                'url' => $appUrl . '/en',
                'languageId' => $englishId,
                'snippetSetId' => $enSnippetSetId,
                'currencyId' => Defaults::CURRENCY,
            ];
        } elseif ($zhSnippetSetId !== null && $domains->filterByProperty('snippetSetId', $zhSnippetSetId)->count() === 0) {
            $newDomainData = [
                'url' => $appUrl . '/zh',
                'languageId' => $chineseId,
                'snippetSetId' => $zhSnippetSetId,
                'currencyId' => Defaults::CURRENCY,
            ];
        }

        if ($newDomainData !== null) {
            $domainUpsertData = \array_merge([
                'id' => '0195f2a18537713090842c238164d23e',
                'salesChannelId' => $salesChannelId,
            ], $newDomainData);

            $this->salesChannelDomainRepository->upsert([$domainUpsertData], $context);
        }
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
        $this->salesChannelDomainRepository->delete([
            [
                'id' => '0195f2a18537713090842c238164d23e',
            ],
        ], $context);
    }

    public function activate(): void
    {
    }

    public function deactivate(): void
    {
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

    private function getSnippetSetId(?string $isoCode = null): ?string
    {
        $result = $this->connection->fetchOne(
            '
                SELECT LOWER(HEX(id))
                FROM snippet_set
                WHERE iso = :languageCode
            ',
            ['languageCode' => $isoCode]
        );

        if ($result === false) {
            return null;
        }

        return (string) $result;
    }
}
