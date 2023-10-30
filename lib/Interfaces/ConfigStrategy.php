<?php

namespace PHPNomad\Config\Interfaces;

use PHPNomad\Config\Exceptions\ConfigException;

interface ConfigStrategy
{
    /**
     * Registers a top-level set of configuration data.
     *
     * @param string $key The top-level key identifying the contents of this config.
     * @param array $configData The data.
     * @return $this
     * @throws ConfigException
     */
    public function register(string $key, array $configData);

    /**
     * Checks to see if a single piece of config data exists.
     * @param string $key A dot-notated string used to look up the config value.
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Gets a single piece of config data, if it exists.
     * @param string $key A dot-notated string used to look up the config value.
     * @param array|string|float|int|bool|null $default Default value to return if this config does not exist.
     * @return array|string|float|int|bool|null
     */
    public function get(string $key, $default = null);
}