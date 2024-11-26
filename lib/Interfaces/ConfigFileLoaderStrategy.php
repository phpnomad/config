<?php

namespace PHPNomad\Config\Interfaces;

use PHPNomad\Config\Exceptions\ConfigException;

interface ConfigFileLoaderStrategy
{
    /**
     * Loads configurations from the specified file.
     *
     * @param string $path
     * @return array
     * @throws ConfigException
     */
    public function loadFileConfigs(string $path): array;
}