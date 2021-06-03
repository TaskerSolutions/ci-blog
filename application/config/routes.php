<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// EXAMPLE
// $route['posts/create'] = 'posts/create';
// routes to Posts.php controller, and to the create() function

// must be before '$route['posts'] = 'posts/index';'
// must be before '$route['posts/(:any)'] = 'posts/view/$1';'
$route['posts/create'] = 'posts/create';

$route['posts/update'] = 'posts/update';

// (:any) selects 'anything' from CI Blog/...
// $1 represents 'anything'
$route['posts/(:any)'] = 'posts/view/$1';

$route['posts'] = 'posts/index';

// Set default page to load when root directory is accessed
$route['default_controller'] = 'pages/view';

$route['categories'] = 'categories/index';
$route['categories/create'] = 'categories/create';
$route['categories/posts/(:any)'] = 'categories/posts/$1';

// (:any) selects 'anything' from CI Blog/...
// $1 represents 'anything'
// Goes directly to '/CI Blog/about'
// ... instead of typing '/CI Blog/pages/view/about'
$route['(:any)'] = 'pages/view/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
