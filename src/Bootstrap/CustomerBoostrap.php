<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use Hey\PlatformDemoData\Helper\TranslationHelper;
use HeyCart\Core\Checkout\Customer\Aggregate\CustomerGroup\CustomerGroupCollection;
use HeyCart\Core\Checkout\Customer\CustomerCollection;
use HeyCart\Core\Defaults;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;
use HeyCart\Core\Framework\Uuid\Uuid;

/**
 * @internal
 */
class CustomerBoostrap extends AbstractBootstrap
{
    final public const HASHED_PASSWORD = '$2y$10$.4fj92PVZTlr/W7.0CF0ROLONadJe29xTIHfK8ofX5fg.Xd2BV5j2';

    private TranslationHelper $translationHelper;

    private Connection $connection;

    /**
     * @var EntityRepository<CustomerGroupCollection>
     */
    private EntityRepository $customerGroupRepository;

    /**
     * @var EntityRepository<CustomerCollection>
     */
    private EntityRepository $customerRepository;

    public function injectServices(): void
    {
        $this->connection = $this->container->get(Connection::class);
        $this->translationHelper = new TranslationHelper($this->connection);
        $this->customerGroupRepository = $this->container->get('customer_group.repository');
        $this->customerRepository = $this->container->get('customer.repository');
    }

    public function install(): void
    {
        $context = $this->installContext->getContext();
        $this->customerGroupRepository->upsert($this->getCustomerGroupPayload(), $context);
        $this->customerRepository->upsert($this->getCustomerPayload(), $context);
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

        $ids = array_map(function ($group) {
            return ['id' => $group['id']];
        }, $this->getCustomerPayload());

        $this->customerRepository->delete($ids, $context);

        $ids = array_map(function ($group) {
            return ['id' => $group['id']];
        }, $this->getCustomerGroupPayload());

        $this->customerGroupRepository->delete($ids, $context);
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
    public function getCustomerGroupPayload(): array
    {
        $salutationId = $this->getSalutationId();

        return [
            [
                'id' => '0194265f62517068a03a07f37a1580b7',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => 'VIP 客户组',
                    'en-GB' => 'VIP customers group',
                ]),
                'registrationActive' => true,
                'registrationTitle' => 'vip',
            ],
            [
                'id' => '0194265f889071d99507a9cc6b09b92f',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '新客户组',
                    'en-GB' => 'New customers group',
                ]),
            ],
            [
                'id' => '0194265fbcac71f7bd3f7ff0e50ddc92',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '测试客户组',
                    'en-GB' => 'Testing customers group',
                ]),
            ],
            [
                'id' => '0194266044b9706a8467c81a3ca36b60',
                'name' => $this->translationHelper->adjustTranslations([
                    'zh-CN' => '积分会员客户组',
                    'en-GB' => 'Loyalty Program Members',
                ]),
            ],
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getCustomerPayload(): array
    {
        $countryId = $this->getCountryId();
        $salutationId = $this->getSalutationId();
        $salesChannelId = $this->getStorefrontSalesChannel();

        return [
            [
                'id' => '6c97534c2c0747f39e8751e43cb2b013',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1000200000022',
                'nickname' => '清风徐来(带收获地址)',
                'password' => static::HASHED_PASSWORD,
                'salutationId' => $salutationId,
                'email' => 'test@test.com',
                'active' => true,
                'phoneNumber'=>'18000000000',
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2019-06-12 07:13:39.641',
                'birthday' => '20001-06-06',
                'groupId' => '0194265fbcac71f7bd3f7ff0e50ddc92',
                'defaultShippingAddress' => [
                    'id' => 'd8f0dff7ef3947979a83c42f6509f22c',
                    'countryId' => $countryId,
                    'city' => '成都市',
                    'phoneNumber' => '12345678',
                    'salutationId' => $salutationId,
                    'name' => 'Admin',
                    'street' => '北京市长安街1号',
                    'zipcode' => '12345',
                ],
            ],
            [
                'id' => '01942639f4c1705eb9e4435201085e5c',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1000000000000',
                'nickname' => '商户A',
                'salutationId' => $salutationId,

                'password' => static::HASHED_PASSWORD,
                'email' => 'test1@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2019-06-12 07:13:39.641',
                'birthday' => '1996-06-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0195afae9ece719a83b54501b9e7c869',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1020000000000',
                'nickname' => '商户B',
                'salutationId' => $salutationId,

                'password' => static::HASHED_PASSWORD,
                'email' => 'admin2@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2019-06-12 07:13:39.641',
                'birthday' => '1996-06-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194263c92f87165ba7962520d9cfd67',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1020030000000',
                'nickname' => '量子行者⚛️',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'shop@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2024-06-12 07:13:39.641',
                'birthday' => '2024-06-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194263fa2da724fafe14289d08433b1',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1020030010000',
                'nickname' => '54程序员',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'zhangsan@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2024-01-01 07:13:39.641',
                'birthday' => '2024-06-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264134f77294ad989649a0613399',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1020030010006',
                'nickname' => '冰封王座❄️',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'lisi@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2024-01-01 07:13:39.641',
                'birthday' => '2024-01-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '019426418d3f720dab671c79d72c77cf',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1020030010050',
                'nickname' => 'wangwu',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'wangwu@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-01 07:13:39.641',
                'birthday' => '2024-01-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942641d96c70329eee9b96f6fb4294',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1020030410000',
                'nickname' => 'vip',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'vip@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2022-01-01 07:13:39.641',
                'birthday' => '2024-01-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942643377673f2bce33486242b5d14',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1021030110000',
                'nickname' => 'nick',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'nick@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-01 07:13:39.641',
                'birthday' => '2024-01-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '019426438903724881be59e1386cda3b',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1020030010001',
                'nickname' => 'wangwang',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'wangwang@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-01 07:13:39.641',
                'birthday' => '2024-01-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942644dbc9729985fb93033e93dd34',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1020030010000',
                'nickname' => 'cicada',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'cicada@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264659fa738b9bef510201faed76',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134030010000',
                'nickname' => 'php',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'php@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942647c7f4722fa402b7c351a2407f',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010090',
                'nickname' => 'tests',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'tests@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264833fb7138ad17db0597ea600c',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010091',
                'nickname' => 'role2',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'role2@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '019426488f56702bb6327b700dbaed9a',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010092',
                'nickname' => 'role',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'role@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942648c578707eab811b4c63ed83e4',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010093',
                'nickname' => 'swag',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'swag@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '019426490ead73f7b19cfaebcca2cc1e',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010094',
                'nickname' => 'resources',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'resources@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264956717143896db0ba03a906b5',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010095',
                'nickname' => 'date',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'date@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942649a40f71dc92fbbd3eb92959c2',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010095',
                'nickname' => 'data',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'data@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942649e7827309a045da7f052c6f6c',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010096',
                'nickname' => 'git',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'git@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264a35b571148f9ef17d86254625',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010097',
                'nickname' => 'public',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'public@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264a931371aebaa155747575cbad',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010098',
                'nickname' => 'admin1234',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'admin1234@test.com',
                'active' => true,
                'group' => [
                    'id' => '0194265f889071d99507a9cc6b09b92f',
                ],
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264af04371a29911b061f2ba07d4',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010099',
                'nickname' => 'test1234',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'test1234@test.com',
                'active' => true,
                'group' => [
                    'id' => '0194265f62517068a03a07f37a1580b7',
                ],
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264b47ba728da6de96c17e53df82',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010100',
                'nickname' => 'demo1234',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'demo1234@test.com',
                'active' => true,
                'guest' => false,
                'group' => [
                    'id' => '0194265fbcac71f7bd3f7ff0e50ddc92',
                ],
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264b92f073ce8e7a1865cf9143da',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010101',
                'nickname' => 'user1234',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'user1234@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264be2a471b6948ab0f5366e7555',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010102',
                'nickname' => 'user6666',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'user6666@test.com',
                'active' => true,
                'group' => [
                    'id' => '0194266044b9706a8467c81a3ca36b60',
                ],
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264c381a72a7b3569ade171af126',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010103',
                'nickname' => 'user7777',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'user7777@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264c7c7970d4ada7cdf2f9349f4e',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010104',
                'nickname' => 'admin1111',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'admin1111@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264cd1dd71fe9cc55b7fbffaf43b',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010105',

                'nickname' => 'admin2222',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'admin2222@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264d0f0b735e913014a8f95583d9',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010106',
                'nickname' => 'admin3333',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'admin3333@test.com',
                'active' => true,
                'guest' => false,

                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264d49ee70eea65b20aa73a9c16a',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010107',
                'nickname' => 'admin4444',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'admin4444@test.com',
                'active' => false,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264d8eb1702c93f3d042a8f045e4',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010108',
                'nickname' => 'admin6666',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'admin6666@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264e0ff273a0b97c218e16f598f1',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010109',
                'nickname' => 'admin8888',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'admin8888@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264e503b7135b698f1e870258b74',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010110',
                'nickname' => 'admin9999',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'admin9999@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264ea2757062b782cc1b43140963',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010111',
                'nickname' => 'test6666',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'test6666@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264ef0ed736696a45777a05c9cdd',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010112',
                'nickname' => 'test8888',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'test8888@test.com',
                'active' => false,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264f2ff37266854464155d727433',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010112',
                'nickname' => 'test9999',
                'salutationId' => $salutationId,
                'group' => [
                    'id' => '0194265fbcac71f7bd3f7ff0e50ddc92',
                ],
                'password' => static::HASHED_PASSWORD,
                'email' => 'test9999@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264f8f2072e6ad73f3078c820143',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010113',
                'nickname' => 'demo6666',
                'salutationId' => $salutationId,

                'password' => static::HASHED_PASSWORD,
                'email' => 'demo6666@test.com',

                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '0194264fcceb730f876a7028378f6a74',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010114',
                'group' => [
                    'id' => '0194265f62517068a03a07f37a1580b7',
                ],
                'nickname' => 'demo8888',
                'salutationId' => $salutationId,

                'password' => static::HASHED_PASSWORD,
                'email' => 'demo8888@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942650159773f8963abb8256527538',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010115',
                'nickname' => 'demo9999',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'demo9999@test.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
            [
                'id' => '01942653b9a273a6b9f2058258d2f63c',
                'salesChannelId' => $salesChannelId,
                'customerNumber' => '1134930010116',
                'nickname' => '👍古方',
                'salutationId' => $salutationId,
                'password' => static::HASHED_PASSWORD,
                'email' => 'demo1000@test.com',
                'group' => [
                    'id' => '0194266044b9706a8467c81a3ca36b60',
                ],
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2023-01-05 07:13:39.641',
                'birthday' => '2024-03-06',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
        ];
    }

    private function getCountryId(): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`id`))
            FROM `country`
            WHERE `active` = 1 and `iso3`="CHN";
        ');

        if ($result === false) {
            throw new \RuntimeException('No active payment method found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
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

    private function getSalutationId(): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(COALESCE(
	            (SELECT `id` FROM `salutation` WHERE `salutation_key` = "mr" LIMIT 1),
	            (SELECT `id` FROM `salutation` LIMIT 1)
            )))
        ');

        if (!$result) {
            throw new \RuntimeException('No salutation found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }
}
