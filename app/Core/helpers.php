<?php

/**
 * Require a view.
 *
 * @param  string $name
 * @param  array  $data
 */
if(!function_exists('view')) {
    function view($view, $data = [])
    {
        $viewname = str_replace('.', '/', $view);
        extract($data);

        return require __DIR__."/../../app/views/{$viewname}.view.php";
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
            $value = trim($value, "'");
            if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
                $value = substr($value, 1, -1);
            }

            // Agregar la variable al entorno
            putenv("$name=$value");

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
        $result =  empty(getenv($key)) ? $default : getenv($key);
        return $result;
    }
}


if(!function_exists('session')) {
    function session($key = null, $value = null)
    {
        // Iniciar la sesión si aún no ha sido iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Si no se proporcionó un valor, obtener el valor de la sesión
        if ($value === null) {
            if ($key === null) {
                // Si tampoco se proporcionó una clave, devolver todos los datos de la sesión
                return $_SESSION;
            } else {
                // Si se proporcionó una clave, devolver el valor correspondiente de la sesión
                return $_SESSION[$key] ?? null;
            }
        } else {
            // Si se proporcionó un valor, establecer el valor en la sesión
            $_SESSION[$key] = $value;
        }
    }
}


/**
 * Clear session.
 *
 *  Establecer un valor en la sesión
 * session('key', 'value');
 * Limpiar la sesión
 * clearSession();
 * Intentar obtener un valor de la sesión
 * $value = session('key');  // Devuelve null
 */
if(!function_exists('clearSession')) {
    function clearSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Liberar todas las variables de sesión
        session_unset();

        // Destruir la sesión
        session_destroy();
    }
}
