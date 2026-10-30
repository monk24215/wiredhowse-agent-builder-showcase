<?php

if (!defined('ABSPATH')) { define('ABSPATH', __DIR__ . '/'); }
// if (!defined('WH_LIB')) { define('WH_LIB',  ABSPATH . 'lib/'); }
// if (!defined('WH_UTIL')) { define('WH_UTIL',  ABSPATH . 'util/'); }
// if (!defined('ENV_FILE')) { define('ENV_FILE', ABSPATH . '.env'); }
require_once ABSPATH . 'bootstrap.php';
//if(!defined('_WHSECURE')) { HttpError::forbidden(); }
/**
 * index.php — root entry. Brief status page + link to admin.
 * Hit when someone visits the root URL (e.g. https://agent.wiredhowse.com/).
 */
// require_once __DIR__ . '/_lib.php';


// Quick connectivity check
$dbOk = false;
$agentCount = 0;
$err = null;
try {
    $agentCount = (int) pdo()->query("SELECT COUNT(*) FROM agent_agents")->fetchColumn();
    $dbOk = true;
} catch (Throwable $e) {
    $err = $e->getMessage();
}

$cfgIssues = [];
$c = cfg();
if (str_contains((string)$c['anthropic_api_key'], 'REPLACE')) $cfgIssues[] = 'Anthropic API key not set in config.php';
if ($c['admin_pin'] === '1234') $cfgIssues[] = 'Admin PIN is still the default (1234) — change it in config.php';
if (str_contains((string)$c['public_url'], 'example.com')) $cfgIssues[] = 'public_url is still placeholder in config.php';

?><!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Agent</title>
<style>
  body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; background: #080808; color: #eeebe5; padding: 40px 24px; max-width: 680px; margin: 0 auto; line-height: 1.6; }
  h1 { color: #e8a020; font-size: 28px; margin-bottom: 8px; }
  .sub { color: #9a948a; font-size: 14px; margin-bottom: 28px; }
  .card { background: #101010; border: 1px solid #222; border-radius: 6px; padding: 22px 24px; margin-bottom: 16px; }
  .ok { color: #22c55e; }
  .err { color: #f43f5e; }
  .warn { color: #e8a020; }
  a.btn { display: inline-block; padding: 10px 18px; background: #e8a020; color: #080808; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 13px; letter-spacing: 0.5px; text-transform: uppercase; }
  a.btn:hover { background: #f0b030; }
  ul { padding-left: 20px; margin-top: 8px; }
  code { background: #161616; padding: 2px 8px; border-radius: 3px; font-size: 13px; }
  .row { display: flex; justify-content: space-between; align-items: center; gap: 16px; }
</style></head>
<body>
<h1>Agent</h1>
<div class="sub">Standalone Claude-powered agent server.</div>

<div class="card">
  <div class="row">
    <strong>Database</strong>
    <span class="<?= $dbOk ? 'ok' : 'err' ?>"><?= $dbOk ? '✓ connected' : '✗ ' . h($err ?: 'not connected') ?></span>
  </div>
  <?php if ($dbOk): ?>
    <div class="row" style="margin-top:8px">
      <span style="color:#9a948a;font-size:14px"><?= $agentCount ?> agent<?= $agentCount === 1 ? '' : 's' ?> configured</span>
    </div>
  <?php endif; ?>
</div>

<?php if (!$dbOk || $agentCount === 0): ?>
<div class="card">
  <strong class="warn">First-run setup needed</strong>
  <p style="margin-top:8px">Visit <a href="install.php" style="color:#e8a020">install.php</a> to create the database tables and seed the default resume agent.</p>
</div>
<?php endif; ?>

<?php if ($cfgIssues): ?>
<div class="card">
  <strong class="warn">Config attention</strong>
  <ul>
    <?php foreach ($cfgIssues as $i): ?><li><?= h($i) ?></li><?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>

<div style="margin-top:24px">
  <a class="btn" href="admin.php">Open Admin →</a>
</div>
</body></html>
<?php // //===================================================
//require_once WH_UTIL . 'wh_securcheck.php';
// //===================================================
?>
