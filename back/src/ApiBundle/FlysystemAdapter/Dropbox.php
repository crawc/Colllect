<?php

namespace ApiBundle\FlysystemAdapter;

use ApiBundle\Entity\User;
use ApiBundle\Exception\DropboxAccessTokenMissingException;
use League\Flysystem\Config;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

class Dropbox extends FlysystemAdapter implements FlysystemAdapterInterface
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;


    /**
     * @param User $user
     * @return FilesystemInterface
     * @throws DropboxAccessTokenMissingException
     */
    public function getFilesystem(User $user)
    {
        if (!$this->filesystem) {
            $token = $user->getDropboxToken();

            if (!$token) {
                throw new DropboxAccessTokenMissingException("error.dropbox_not_linked");
            }

            $client = new DropboxClient($token);
            $adapter = $this->cacheAdapter(new DropboxAdapter($client), $user);

            $this->filesystem = new Filesystem(
                $adapter, new Config(
                    [
                        'disable_asserts' => true,
                    ]
                )
            );
        }

        return $this->filesystem;
    }
}
