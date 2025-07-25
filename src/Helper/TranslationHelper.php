<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Helper;

use Doctrine\DBAL\Connection;

/**
 * @internal
 */
class TranslationHelper
{
    // Which language to use if no translation for the wanted language is available
    private const DEFAULT_TRANSLATION_LANGUAGE = 'en-GB';

    private DbHelper $dbHelper;

    public function __construct(Connection $connection)
    {
        $this->dbHelper = new DbHelper($connection);
    }

    /**
     * @param array<string, mixed> $translations
     *
     * @return array<string, mixed>
     */
    public function adjustTranslations(array $translations): array
    {
        $systemLanguageCode = $this->dbHelper->getSystemLanguageCode();

        if (!isset($translations[$systemLanguageCode])) {
            $translations[$systemLanguageCode] = $translations[self::DEFAULT_TRANSLATION_LANGUAGE];
        }

        return $this->clearUnavailableTranslations($translations);
    }

    /**
     * @param array<string, mixed> $translations
     *
     * @return array<string, mixed>
     */
    private function clearUnavailableTranslations(array $translations): array
    {
        $availableCodes = [];
        foreach ($translations as $code => $value) {
            $languageId = $this->dbHelper->getLanguageId($code);
            if ($languageId !== null) {
                $availableCodes[$code] = $value;
            }
        }

        return $availableCodes;
    }
}
