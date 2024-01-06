<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buildkit on DDEV</title>
</head>

<body>
    <h1>Buildkit on DDEV</h1>
    <?php
    $buildkitDomain = getenv('BUILDKIT_DOMAIN');
    $dirs = glob('/var/www/html/build/*', GLOB_ONLYDIR);
    // if no dirs found, show error
    if (empty($dirs)) {
    ?>
        <h2>No sites found</h2>
        <p>Please run <code>ddev exec civibuild create <buildtype></code> to create a new site.</p>
    <?php
        exit;
    }
    ?>
    <h2>Available sites</h2>
    <ul>
    <?php
    foreach ($dirs as $dir) {
        $dirName = basename($dir);
        echo "<li><a href='https://$dirName.$buildkitDomain'>$dirName</a></li>";
    }
    ?>
    </ul>
</body>

</html>
