<?php

/**
 * Require a view.
 *
 * @param  string $name
 * @param  array  $data
 */
if(!function_exists('view')) {
    function view($name, $data = [])
    {
        extract($data);

        return require __DIR__."/../../app/views/{$name}.view.php";
    }
}

/**
 * Redirect to a new page.
 *
 * @param  string $path
 */
if(!function_exists('redirect')) {
    function redirect($path)
    {
        header("Location: /{$path}");
    }
}


if(!function_exists('loadConfig')) {
    function loadConfig($key)
    {
        return require __DIR__.'/../../config/'."{$key}.php";
    }
}

if(!function_exists('loadEnv')) {
    function loadEnv($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception('.env file does not exist.');
        }

        // Leer las líneas del archivo .env
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // Ignorar los comentarios
            if (str_starts_with(ltrim($line), '#')) {
                continue;
            }

            // Separar el nombre y el valor
            list($name, $value) = explode('=', $line, 2);

            // Eliminar las comillas del valor si existen
            $value = trim($value);
            $value = trim($value,"'");
            if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
                $value = substr($value, 1, -1);
            }

            // Agregar la variable al entorno
            putenv("$name=$value");

            // También puedes usar $_ENV o $_SERVER si lo prefieres
            // $_ENV[$name] = $value;
            // $_SERVER[$name] = $value;
        }
        // Uso:
        //loadEnv(__DIR__ . '/.env');

        // Ahora puedes acceder a tus variables de entorno
        //echo getenv('MY_VARIABLE');

    }
}
if(!function_exists('env')) {
    function env($key, $default='')
    {
        $result =  empty(getenv($key))?$default:getenv($key);
        return $result;
    }
}
