<?php

if (! function_exists('get_gravatar')) {
    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s     Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d     Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r     Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole  $img   True to return a complete IMG tag False for just the URL
     * @param array  $atts  Optional, additional key/value attributes to include in the IMG tag
     *
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    function get_gravatar($email, $s = 150, $d = 'mm', $r = 'g', $img = false, $atts = [])
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }

        return $url;
    }
}

/**
 * Environment file not found.
 */
const ENV_NOT_FOUND = - 1;
/**
 * Environment file is not writable.
 */
const ENV_DENIED = - 2;
/**
 * Environment file updated.
 */
const ENV_UPDATED = 1;

if (! function_exists('env_put')) {
    /**
     * Store or update an environment variable.
     *
     * @param      $key
     * @param      $value
     * @param bool $new_line
     *
     * @return int
     *
     * @author Cali
     */
    function env_put($key, $value, $new_line = false) : int
    {
        $path = base_path('.env');
        $key = strtoupper($key);
        if (str_contains($value, " ")) {
            $value = str_replace(" ", "-", $value);
        }
        if (file_exists($path)) {
            $content = $new_line ? "\n\r{$key}={$value}" : "\n{$key}={$value}";
            if (is_null(env($key))) {
                try {
                    file_put_contents($path, $content, FILE_APPEND);
                } catch (Exception $e) {
                    return ENV_DENIED;
                }
            } else {
                $content = str_replace($new_line ? "\n\r" : "\n", "", $content);
                $v = env($key);
                if (is_bool($v)) {
                    $v = strval($v ? 'true' : 'false');
                }
                try {
                    file_put_contents($path,
                        str_replace("{$key}={$v}", $content, file_get_contents($path))
                    );
                } catch (Exception $e) {
                    return ENV_DENIED;
                }
            }

            return ENV_UPDATED;
        }

        return ENV_NOT_FOUND;
    }
}

if (! function_exists('site')) {
    /**
     * Helper for getting the site configuration.
     *
     * @param $name
     * @return string|null|bool
     *
     * @author Cali
     */
    function site($name, $default = null)
    {
        $site = app('Site');

        $result = call_user_func_array([$site, $name], []);

        return is_null($result) ? $default : $result;
    }
}