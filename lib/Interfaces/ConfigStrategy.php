<?php

namespace Phoenix\Config\Interfaces;

use Phoenix\Config\Exceptions\ConfigException;
use Phoenix\Config\Exceptions\ConfigNotFoundException;

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
     * Gets a single piece of config data, if it exists.
     * @param string $key A dot-notated string used to look up the config value.
     * @param array|string|float|int|bool|null $default Default value to return if this config does not exist.
     * @return array|string|float|int|bool|null
     * @throws ConfigNotFoundException
     */
    public function get(string $key, $default = null);
}