<?php
/**
 * SmartFlat CMS v3 - Game Preview Proxy
 * Loads game index.html with getgamedata pre-injected from smartflat_claude_html
 *
 * Usage: game-preview.php?hm_idx=2
 */

session_start();

// Include DB
require_once(__DIR__ . '/../lib/db.php');

$hmIdx = isset($_GET['hm_idx']) ? (int)$_GET['hm_idx'] : 0;

if ($hmIdx <= 0) {
    http_response_code(400);
    echo 'Missing hm_idx parameter';
    exit;
}

// Load home data
$home = db()->fetchOne("SELECT * FROM tb_home WHERE hm_idx = ?", [$hmIdx]);

if (!$home) {
    http_response_code(404);
    echo 'Home data not found';
    exit;
}

$projectId = $home['hm_projectid'];
$grIdx = (int)($home['hm_gr_idx'] ?? 0);

// Validate projectId to prevent path traversal
if (!preg_match('/^[a-zA-Z0-9_-]+$/', $projectId)) {
    http_response_code(400);
    echo 'Invalid project ID';
    exit;
}

$gamePath = "../../../game/school/{$projectId}/v{$grIdx}/";

// Build the game page with injected data
$homeDataJson = $home['hm_home_data'] ?: '[]';
$mainDataJson = $home['hm_main_data'] ?: '[]';
$contentDataJson = $home['hm_content_data'] ?: '[]';

// Read the original index.html to extract canvas size and scripts
$indexPath = __DIR__ . "/../../../../game/school/{$projectId}/v{$grIdx}/index.html";

if (!file_exists($indexPath)) {
    http_response_code(404);
    echo "Game not found: {$projectId}/v{$grIdx}";
    exit;
}

$indexHtml = file_get_contents($indexPath);

// Extract param_sw, param_sh from the index.html
preg_match('/var\s+param_sw\s*=\s*(\d+)/', $indexHtml, $swMatch);
preg_match('/var\s+param_sh\s*=\s*(\d+)/', $indexHtml, $shMatch);
$sw = $swMatch[1] ?? ($home['hm_width'] ?: 1080);
$sh = $shMatch[1] ?? ($home['hm_height'] ?: 1920);

// Safe JSON encoding for embedding in script
$homeJson = json_encode(json_decode($homeDataJson), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);
$mainJson = json_encode(json_decode($mainDataJson), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);
$contentJson = json_encode(json_decode($contentDataJson), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);

// Build the home data object that the game expects
$orientation = $home['hm_orientation'] ?: 'P';
$width = $home['hm_width'] ?: 0;
$height = $home['hm_height'] ?: 0;
$region = htmlspecialchars($home['hm_region'] ?? '', ENT_QUOTES);
$safetyOnoff = (int)($home['hm_safety_onoff'] ?? 0);
$safetyClosetime = (int)($home['hm_safety_closetime'] ?? 0);
$language = htmlspecialchars($home['hm_language'] ?? 'KO', ENT_QUOTES);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview - <?php echo htmlspecialchars($projectId); ?></title>
    <style>
        * { margin: 0; padding: 0; }
        body { background: #000; overflow: hidden; }
        #gameCanvas { display: block; }
    </style>
</head>
<body>
<script>
    // URL parameter helpers (game expects these)
    function getParam(sname) {
        var params = location.search.substr(location.search.indexOf("?") + 1);
        var sval = "";
        params = params.split("&");
        for (var i = 0; i < params.length; i++) {
            temp = params[i].split("=");
            if ([temp[0]] == sname) { sval = temp[1]; }
        }
        return sval;
    }

    // Pre-inject game data from DB (bypasses ssapi/adm_get.php)
    var getgamedata = {
        hm_idx: <?php echo (int)$hmIdx; ?>,
        hm_projectid: "<?php echo htmlspecialchars($projectId, ENT_QUOTES); ?>",
        hm_orientation: "<?php echo $orientation; ?>",
        hm_width: <?php echo (int)$width; ?>,
        hm_height: <?php echo (int)$height; ?>,
        hm_home_data: JSON.stringify(<?php echo $homeJson; ?>),
        hm_main_data: JSON.stringify(<?php echo $mainJson; ?>),
        hm_content_data: JSON.stringify(<?php echo $contentJson; ?>),
        hm_region: "<?php echo $region; ?>",
        hm_safety_onoff: <?php echo $safetyOnoff; ?>,
        hm_safety_closetime: <?php echo $safetyClosetime; ?>,
        hm_language: "<?php echo $language; ?>"
    };

    var param_projectid = "<?php echo htmlspecialchars($projectId, ENT_QUOTES); ?>";
    var param_groupidx = <?php echo (int)$grIdx; ?>;
    var param_sw = <?php echo (int)$sw; ?>;
    var param_sh = <?php echo (int)$sh; ?>;
    var param_today_first = true;
    var param_subtitle = "";
    var param_lyrics = [];
    var param_level = 1;
    var param_isword = false;
    var app_fcmtoken = "";
    var global_app_datalist = [];

    function AndroidCallback(key, value) {}
    function IOSCallback(key, value) {}
    function CheckAppCallbackData(key) { return null; }

    // Override AJAX_AdmGet to use pre-loaded data
    var _originalAjaxAdmGet = null;
    function _patchAjaxAfterLoad() {
        if (typeof AJAX_AdmGet === 'function' && !_originalAjaxAdmGet) {
            _originalAjaxAdmGet = AJAX_AdmGet;
            AJAX_AdmGet = function(type, data, success, error) {
                if (type === "gethomedata" || type === ADM_TYPE.GET_HOME_DATA) {
                    // Return pre-loaded data directly
                    if (success) success({ code: 100, message: getgamedata });
                    return;
                }
                // Fall through to original for other types
                _originalAjaxAdmGet(type, data, success, error);
            };
        }
    }
</script>

<canvas id="gameCanvas" width="<?php echo (int)$sw; ?>" height="<?php echo (int)$sh; ?>"></canvas>

<?php
// Load all the game's JS files in order from the original index.html
// Extract script src tags
preg_match_all('/<script[^>]+src="([^"]+)"[^>]*>/i', $indexHtml, $scriptMatches);

$basePath = "/claude_project/html/game/school/{$projectId}/v{$grIdx}/";

foreach ($scriptMatches[1] as $idx => $src) {
    $fullSrc = $basePath . $src;

    // Before main.js loads, inject the AJAX override
    if (strpos($src, 'main.js') !== false) {
        echo "<script>\n";
        echo "// Override AJAX_AdmGet BEFORE main.js runs\n";
        echo "// main.js calls AJAX_AdmGet inside cc.game.onStart callback\n";
        echo "// The game's cmn_fnc.js defines AJAX_AdmGet, but main.js uses it\n";
        echo "// We intercept at the CallHandler level which is called by AJAX_AdmGet\n";
        echo "var _v3_preview_mode = true;\n";
        echo "</script>\n";
    }

    echo "<script type=\"text/javascript\" src=\"{$fullSrc}\" charset=\"UTF-8\"></script>\n";
}
?>

<script>
    // After all scripts loaded, patch the CallHandler to intercept gethomedata
    (function() {
        if (typeof CallHandler === 'function') {
            var _origCallHandler = CallHandler;
            CallHandler = function(type, data, success, error, showLoading) {
                // Intercept gethomedata requests - use pre-loaded data
                if (data && data.type === 'gethomedata') {
                    console.log('[v3-preview] Intercepted gethomedata, using pre-loaded data');
                    if (success) success({ code: 100, message: getgamedata });
                    return;
                }
                // Other requests: try original but catch errors gracefully
                try {
                    _origCallHandler(type, data, success, error, showLoading);
                } catch(e) {
                    console.warn('[v3-preview] CallHandler error (non-critical):', e.message);
                    if (error) error(e);
                }
            };
        }
    })();
</script>
</body>
</html>
