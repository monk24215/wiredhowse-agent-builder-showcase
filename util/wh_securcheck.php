<?php
if(!defined('ABSPATH') ||!class_exists('FileLoader') || !class_exists('PageRenderer') ) {  die('error!!'); }
if(!defined('_WHSECURE')) {PageRenderer::render('403', 'util');   die('error!!');  }
