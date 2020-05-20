<?php
// \!/~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\!/
//     DON'T MODIFY THIS FILE, AUTOGENERATED
// \!/~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\!/

//
// Load react app
//
function load_react_scripts_css() {
    //
    // clear all javascript and css
    //
    global $wp_styles;
    global $wp_scripts;
    $wp_styles->queue = [];
    $wp_scripts->queue = [];

    //
    // Load react scripts
    //
    $theme_path = dirname(__FILE__);
    $manifest_path = $theme_path . '/build/asset-manifest.json';
    $asset_manifest = json_decode(file_get_contents($manifest_path), true)['files'];

    $main_css = $asset_manifest['main.css'];
    $main_js = $asset_manifest['main.js'];
    $runtime_js = $asset_manifest['runtime-main.js'];
    if (empty($runtime_js)) $runtime_js = $asset_manifest['runtime~main.js'];

    $last_js_chunk = '';
    $last_css_chunk = '';

    // from https://www.digitalocean.com/community/tutorials/how-to-embed-a-react-application-in-wordpress-on-ubuntu-18-04
    foreach ($asset_manifest as $key => $value) {
        if (preg_match('@static/js/(.*)\.chunk\.js@', $key, $matches)) {
            if ($matches && is_array($matches) && count($matches) === 2) {
                $name = "cra-" . preg_replace('/[^A-Za-z0-9_]/', '-', $matches[1]);
                wp_enqueue_script($name, get_site_url() . $value, [], null, true);
                $last_js_chunk = $name;
            }
        }

        if (preg_match('@static/css/(.*)\.chunk\.css@', $key, $matches)) {
            if ($matches && is_array($matches) && count($matches) == 2) {
                $name = "cra-" . preg_replace('/[^A-Za-z0-9_]/', '-', $matches[1]);
                wp_enqueue_style($name, get_site_url() . $value, [], null);
                $last_css_chunk = $name;
            }
        }
    }

    if (isset($main_css)) {
        wp_enqueue_style('cra-css', $main_css, [$last_css_chunk], null);
    }
    if (isset($main_js)) {
        wp_enqueue_script('cra-js', $main_js, [$last_js_chunk], null, true);
    }
    if (isset($runtime_js)) {
        wp_enqueue_script('cra-runtime', $runtime_js, [], null, true);
    }
}

add_action('wp_enqueue_scripts', 'load_react_scripts_css');


function load_react_app()
{
    $build_path = parse_url(get_template_directory_uri() . '/build', PHP_URL_PATH); ?>
<!doctype html>
<html lang="en">
<head>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <?php wp_head(); ?>
</head>

<body>
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <div id="root"></div>

  <?php wp_footer(); ?>
</body>
</html>
<?php
}

// \!/~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\!/
//     DON'T MODIFY THIS FILE, AUTOGENERATED
// \!/~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\!/
