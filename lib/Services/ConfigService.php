<?php

namespace PHPNomad\Config\Services;

use PHPNomad\Config\Exceptions\ConfigException;
use PHPNomad\Config\Interfaces\ConfigFileLoaderStrategy;
use PHPNomad\Config\Interfaces\ConfigStrategy;

class ConfigService
{
    public function __construct(protected ConfigStrategy $configStrategy, protected ConfigFileLoaderStrategy $configFileLoaderStrategy)
    {

    }

    /**
     * Registers the specified file's configuration.
     *
     * @param string $key
     * @param string $path
     * @return $this
     * @throws ConfigException
     */
    public function registerConfig(string $key, string $path): static
    {
        $configs = $this->configFileLoaderStrategy->loadFileConfigs($path);

        $this->configStrategy->register($key, $configs);

        return $this;
    }
}