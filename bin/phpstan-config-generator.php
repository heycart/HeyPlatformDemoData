<?php declare(strict_types=1);

use HeyCart\Core\DevOps\StaticAnalyze\StaticAnalyzeKernel;
use HeyCart\Core\Framework\Adapter\Kernel\KernelFactory;
use HeyCart\Core\Framework\Plugin\KernelPluginLoader\StaticKernelPluginLoader;
use Hey\PlatformDemoData\HeyPlatformDemoData;
use Symfony\Component\Dotenv\Dotenv;

$projectRoot = dirname(__DIR__, 4);
$pluginRootPath = dirname(__DIR__);

$classLoader = require $projectRoot . '/vendor/autoload.php';
if (file_exists($projectRoot . '/.env')) {
    (new Dotenv())->usePutEnv()->bootEnv($projectRoot . '/.env');
}

/** @var array{'autoload': array{}} $composer */
$composer = json_decode((string) file_get_contents($pluginRootPath . '/composer.json'), true);

$pluginLoader = new StaticKernelPluginLoader($classLoader, null, [
    [
        'name' => 'HeyPlatformDemoData',
        'active' => true,
        'version' => $composer['version'],
        'baseClass' => HeyPlatformDemoData::class,
        'managedByComposer' => false,
        'autoload' => $composer['autoload'],
        'path' => $pluginRootPath,
    ],
]);

KernelFactory::$kernelClass = StaticAnalyzeKernel::class;

/** @var StaticAnalyzeKernel $kernel */
$kernel = KernelFactory::create('dev', true, $classLoader, $pluginLoader);
$kernel->boot();

$phpStanConfigDist = file_get_contents($pluginRootPath . '/phpstan.neon.dist');
if ($phpStanConfigDist === false) {
    throw new RuntimeException('phpstan.neon.dist file not found');
}

// because the cache dir is hashed by HeyCart, we need to set the PHPStan config dynamically
$phpStanConfig = str_replace(
    [
        '%HeyCartHashedCacheDir%',
        '%HeyCartRoot%',
        '%HeyCartKernelClass%',
    ],
    [
        str_replace($kernel->getProjectDir(), '', $kernel->getCacheDir()),
        $projectRoot . (is_dir($projectRoot . '/platform') ? '/platform' : ''),
        str_replace('\\', '_', $kernel::class),
    ],
    $phpStanConfigDist
);

file_put_contents(__DIR__ . '/../phpstan.neon', $phpStanConfig);

return $classLoader;
