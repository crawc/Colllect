<?php

namespace ApiBundle\EnhancedFlysystemAdapter;

use League\Flysystem\FilesystemInterface;

/**
 * @method array listWith(array $keys = [], string $directory = '', bool $recursive = false) List with plugin adapter
 */
interface EnhancedFilesystemInterface extends FilesystemInterface
{
    /**
     * Rename a directory
     *
     * @param string $path
     * @param string $newPath
     *
     * @return bool
     */
    public function renameDir(string $path, string $newPath): bool;
}
