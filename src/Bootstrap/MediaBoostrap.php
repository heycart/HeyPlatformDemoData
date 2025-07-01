<?php declare(strict_types=1);

namespace Hey\PlatformDemoData\Bootstrap;

use Doctrine\DBAL\Connection;
use HeyCart\Core\Content\Media\File\FileSaver;
use HeyCart\Core\Content\Media\File\MediaFile;
use HeyCart\Core\Content\Media\MediaCollection;
use HeyCart\Core\Framework\Context;
use HeyCart\Core\Framework\DataAbstractionLayer\EntityRepository;

/**
 * @internal
 */
class MediaBoostrap extends AbstractBootstrap
{
    private FileSaver $fileSaver;

    private Connection $connection;

    /**
     * @var EntityRepository<MediaCollection>
     */
    private EntityRepository $mediaRepository;

    public function injectServices(): void
    {
        $this->fileSaver = $this->container->get(FileSaver::class);
        $this->connection = $this->container->get(Connection::class);
        $this->mediaRepository = $this->container->get('media.repository');
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getPayload(): array
    {
        $cmsFolder = $this->getDefaultFolderIdForEntity('cms_page');
        $productFolder = $this->getDefaultFolderIdForEntity('product');

        return [
            [
                'id' => 'de4b7dbe9d95435092cb85ce146ced28',
                'mediaFolderId' => $cmsFolder,
            ],
            [
                'id' => '84356a71233d4b3e9f417dcc8850c82f',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '01969ce27621706288b81b3f3d1db607',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '01969ce6bfc17264ab7938fe729442cc',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '019787a21bcf720594e1408a1d8361b2',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '019787c4feab7373994867e7a55896b5',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '019787c7d22b71de80037e5629f2536c',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '019787cfd2be71278f4db3a453a280bf',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '019787d0c21172109a1dfe3ba67e9270',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '019787d18d2b71d68f62fd7fc06bd86c',
                'mediaFolderId' => $productFolder,
            ],
        ];
    }

    public function install(): void
    {
        $context = $this->installContext->getContext();
        $this->mediaRepository->upsert($this->getPayload(), $context);
        $this->finalize($context);
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
        $this->mediaRepository->delete($this->getPayload(), $context);
    }

    public function activate(): void
    {
    }

    public function deactivate(): void
    {
    }

    public function finalize(Context $context): void
    {
        $files = \glob(__DIR__ . '/../Resources/media/*/*.{jpg,png,svg}', \GLOB_BRACE);
        if ($files === false) {
            return;
        }

        foreach ($files as $file) {
            $mimeType = \mime_content_type($file);

            if ($mimeType === false) {
                $mimeType = 'application/octet-stream';
            }

            $filesize = \filesize($file);
            if ($filesize === false) {
                $filesize = 0;
            }
            $this->fileSaver->persistFileToMedia(
                new MediaFile(
                    $file,
                    $mimeType,
                    \pathinfo($file, \PATHINFO_EXTENSION),
                    $filesize
                ),
                \pathinfo($file, \PATHINFO_FILENAME),
                \basename(\dirname($file)),
                $context
            );
        }
    }

    private function getDefaultFolderIdForEntity(string $entity): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`media_folder`.`id`))
            FROM `media_default_folder`
            JOIN `media_folder` ON `media_default_folder`.`id` = `media_folder`.`default_folder_id`
            WHERE `media_default_folder`.`entity` = :entity;
        ', ['entity' => $entity]);

        if ($result === false) {
            throw new \RuntimeException('No default folder for entity "' . $entity . '" found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }
}
