<?php

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    function env(string $key, mixed $default = null): mixed
    {
        $value = $_ENV[$key];

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'null':
            case '(null)':
                return null;

            case 'empty':
            case '(empty)':
                return '';
        }

        if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     *
     * @return mixed
     */
    function value(mixed $value): mixed
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('str_ends_with')) {
    /**
     * Determine if a given string ends with a given substring.
     *
     * @param string $haystack
     * @param array|string $needles
     *
     * @return bool
     */
    function str_ends_with(string $haystack, array|string $needles): bool
    {
        foreach ((array)$needles as $needle) {
            if ((string)$needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('load_environment')) {
    /**
     * Load specified environment.
     *
     * @param string $env
     *
     * @return \Dotenv\Dotenv|null
     */
    function load_environment(string $env = ''): ?\Dotenv\Dotenv
    {
        $file   = sprintf('%s/.env', APPLICATION_DIR);
        $file   = basename(file_exists($file) ? $file : sprintf('%s/.env', APPLICATION_DIR));
        $dotenv = null;

        if (file_exists(APPLICATION_DIR . DIRECTORY_SEPARATOR . $file)) {
            $dotenv = Dotenv\Dotenv::createImmutable(APPLICATION_DIR);
            $dotenv->load();
        }

        return $dotenv;
    }
}
