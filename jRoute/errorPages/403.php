<?php http_response_code(403); ?>

<!DOCTYPE html>
<html>

<head>
    <title>403 Forbidden</title>
    <link href="../style.css" rel="stylesheet">
</head>

<body class="routingBody">
    <div class="error-box">
        <h1>403 Forbidden</h1>
        <p>You do not have permission to access this page.</p>
        <code><?= htmlspecialchars($_GET['error_uri']) ?></code>
    </div>
</body>

</html>