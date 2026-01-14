<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Apache Docker Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .info-section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #4CAF50;
        }
        .success {
            color: #4CAF50;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 PHP Apache Docker Template</h1>
        
        <div class="info-section">
            <p class="success">✓ Apache server is running successfully!</p>
            <p class="success">✓ PHP is configured and working!</p>
        </div>

        <h2>Server Information</h2>
        <table>
            <tr>
                <th>Property</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>PHP Version</td>
                <td><?php echo phpversion(); ?></td>
            </tr>
            <tr>
                <td>Apache Version</td>
                <td><?php echo apache_get_version(); ?></td>
            </tr>
            <tr>
                <td>Server Software</td>
                <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
            </tr>
            <tr>
                <td>Server Name</td>
                <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
            </tr>
            <tr>
                <td>Server Port</td>
                <td><?php echo $_SERVER['SERVER_PORT']; ?></td>
            </tr>
            <tr>
                <td>Document Root</td>
                <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td>
            </tr>
            <tr>
                <td>Server Time</td>
                <td><?php echo date('Y-m-d H:i:s'); ?></td>
            </tr>
        </table>

        <h2>Loaded PHP Extensions</h2>
        <div class="info-section">
            <?php
            $extensions = get_loaded_extensions();
            sort($extensions);
            echo '<p>' . implode(', ', $extensions) . '</p>';
            ?>
        </div>

        <h2>PHP Configuration</h2>
        <table>
            <tr>
                <th>Directive</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>memory_limit</td>
                <td><?php echo ini_get('memory_limit'); ?></td>
            </tr>
            <tr>
                <td>upload_max_filesize</td>
                <td><?php echo ini_get('upload_max_filesize'); ?></td>
            </tr>
            <tr>
                <td>post_max_size</td>
                <td><?php echo ini_get('post_max_size'); ?></td>
            </tr>
            <tr>
                <td>max_execution_time</td>
                <td><?php echo ini_get('max_execution_time'); ?> seconds</td>
            </tr>
            <tr>
                <td>display_errors</td>
                <td><?php echo ini_get('display_errors') ? 'On' : 'Off'; ?></td>
            </tr>
        </table>

        <div class="info-section" style="margin-top: 30px;">
            <h3>Next Steps</h3>
            <ul>
                <li>Place your PHP application files in the <code>public/</code> directory</li>
                <li>Customize Apache configuration in <code>apache/conf/000-default.conf</code></li>
                <li>Access logs are available in <code>apache/logs/</code></li>
                <li>Full PHP info available at <a href="phpinfo.php">phpinfo.php</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
