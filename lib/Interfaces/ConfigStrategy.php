<?php
namespace Phoenix\Core\Interfaces;

interface ConfigStrategy
{
    public function register(array $configData);
}