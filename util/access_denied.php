<?php
if (
    $_SERVER['REQUEST_METHOD'] === 'GET' &&
    ($_GET['pg'] ?? '') === 'cb_dashboard' &&
    array_key_exists('pass', $_GET)
) {

    require_once ABSPATH . 'helpers/' . 'rate_limit.php';

    $pass = trim($_GET['pass']);

    // if ($pass === '') {
    //     http_response_code(400);
    //     exit;
    // }

    // // continue normal rendering
    // PageRenderer::render('cb_dashboard', 'pages');
    // exit;
}

    $psm = false; //'Add ?pass=YOUR_PASSWORD to the URL'; 
    // http_response_code(403);
     HttpError::forbidden("You don't have permission to access this resource.");
die(' <!DOCTYPE html><html><head><title>
        Access Denied</title>
        </head>
        <body style="font-family: Arial; padding: 50px; text-align: center;">
        <h1>🔒 Access Denied</h1><p>' .$psm . '</p>
        </body>
    </html>
    ');




?>



<script>
(() => {
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', e => {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
})();
</script>
