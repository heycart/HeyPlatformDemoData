<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use HeyCart\Core\Content\Rule\RuleCollection;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;

/**
 * @internal
 */
class RuleBoostrap extends AbstractBootstrap
{
    private Connection $connection;

    /**
     * @var EntityRepository<RuleCollection>
     */
    private EntityRepository $ruleRepository;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->ruleRepository = $this->container->get('rule.repository');
    }

    public function install(): void
    {
        $context = $this->installContext->getContext();
        $this->ruleRepository->upsert($this->getPayload(), $context);
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
        $this->ruleRepository->delete($ids, $context);
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
        $cnId = $this->getCountryIdByIsoCode('CN');

        return [
            [
                'id' => '28caae75a5624f0d985abd0eb32aa160',
                'name' => 'All customers of the test customer group',
                'priority' => 1,
                'conditions' => [
                    [
                        'type' => 'orContainer',
                        'children' => [
                            [
                                'type' => 'andContainer',
                                'children' => [
                                    [
                                        'type' => 'customerCustomerGroup',
                                        'value' => [
                                            'operator' => '=',
                                            'customerGroupIds' => ['0194265fbcac71f7bd3f7ff0e50ddc92'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    private function getCountryIdByIsoCode(string $iso): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`id`))
            FROM `country`
            WHERE `iso` = :iso;
        ', ['iso' => $iso]);

        if ($result === false) {
            throw new \RuntimeException('No country for iso code "' . $iso . '" found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }
}
