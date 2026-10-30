<?php
/**
 * config.php — the ONLY file you edit.
 * Fill in DB credentials, your Anthropic API key, and an admin PIN.
 */
 if(!defined('DB_HOST')){define('DB_HOST','mysql.railway.internal');  }
 if(!defined('DB_NAME')){define('DB_NAME','railway'); }
 if(!defined('DB_USER')){define('DB_USER','root'); }
 if(!defined('DB_PASS')){define('DB_PASS',''); }
return [
    // === Database ===
    'db' => [
        'host' => DB_HOST,
        'name' => DB_NAME,
        'user' => DB_USER,
        'pass' => DB_PASS,
        'charset' => 'utf8mb4',
    ],

    // === Anthropic API ===
    'anthropic_api_key' => 'REPLACE_WITH_YOUR_KEY',
    'model'             => 'claude-haiku-4-5-20251001', // fast + cheap; use claude-sonnet-4-6 for higher quality
    'max_tokens'        => 1024,

    // === Admin ===
    'admin_pin' => '5309', // CHANGE THIS — used to log into admin.php

    // === Embed ===
    // The public URL where this folder lives, e.g. https://agentollie.wiredhowse.com
    // Used by the widget snippet shown in the admin. No trailing slash.
    'public_url' => 'https://wiredhowse-visitor-agent-production.up.railway.app',
];
