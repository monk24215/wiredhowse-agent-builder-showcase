<?php
/////////////////////////////////////////////
//=========================================
require_once __DIR__ . '/bootstrap.php';
///=================================================
////////////////////////////////////////////////////
$pg = QueryParam::get('pg', 'home');
PageRenderer::render($pg, 'public');

// PageRenderer::render('foot', 'templates');

