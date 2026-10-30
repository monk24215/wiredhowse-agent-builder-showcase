<?php
/**
 * config.php — credentials and tunables.
 *
 * Two ways to configure:
 *   A) Edit the values below directly (traditional shared hosting).
 *   B) Set environment variables (Railway, Heroku, Docker, etc.) — env vars
 *      override the literal values below. The env var names are listed in [].
 *
 * On Railway: provision a MySQL service in your project. Railway auto-injects
 * MYSQLHOST, MYSQLPORT, MYSQLUSER, MYSQLPASSWORD, MYSQLDATABASE into your
 * service. Set ANTHROPIC_API_KEY, ADMIN_PIN, and PUBLIC_URL in the Variables
 * tab. Done.
 */

function _env(string $key, $default) {
    $v = getenv($key);
    return ($v === false || $v === '') ? $default : $v;
}

return [
    // === Database ===
    'db' => [
        'host'    => _env('MYSQLHOST',     _env('DB_HOST',     'mysql.railway.internal')),
        'port'    => (int) _env('MYSQLPORT', _env('DB_PORT',     3306)),
        'name'    => _env('MYSQLDATABASE', _env('DB_NAME',     'railway')),
        'user'    => _env('MYSQLUSER',     _env('DB_USER',     'root')),
        'pass'    => _env('MYSQLPASSWORD', _env('DB_PASS',     '')),
        'charset' => 'utf8mb4',
    ],

    // === Anthropic API ===                              [ANTHROPIC_API_KEY]
    'anthropic_api_key' => _env('ANTHROPIC_API_KEY', 'REPLACE_WITH_YOUR_KEY'),
    'model'             => _env('ANTHROPIC_MODEL', 'claude-opus-4-7'),
    'max_tokens'        => (int) _env('ANTHROPIC_MAX_TOKENS', 2500),

    // === Admin ===                                      [ADMIN_PIN]
    'admin_pin' => _env('ADMIN_PIN', ''),

    // === Embed ===                                      [PUBLIC_URL]
    // Public URL of this deployment, no trailing slash. Used in admin embed snippet.
    'public_url' => _env('PUBLIC_URL', 'https://quick-agent.wiredhowse.app/'),
];
