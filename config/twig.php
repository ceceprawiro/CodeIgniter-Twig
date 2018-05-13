<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Twig template engine implementation for CodeIgniter.
 * Modified from Twiggy by Edmundas Kondrašovas.
 *
 * @package     CodeIgniter
 * @subpackage  Twig
 * @category    Libraries
 * @author      Cecep Prawiro <github.com/ceceprawiro>
 * @license     http://www.opensource.org/licenses/MIT
 * @version     1.0
 * @copyright   Copyright (c) 2018 Cecep Prawiro <github.com/ceceprawiro>
*/

/*
| -------------------------------------------------------------------
| Default theme
| -------------------------------------------------------------------
*/
$config['twig']['theme'] = 'default';

/*
| -------------------------------------------------------------------
| Themes Base Dir
| -------------------------------------------------------------------
|
| Directory where themes are located at. This path is relative to
| CodeIgniter's base directory OR module's base directory.
|
| For example:
| $config['theme_dir'] = 'themes';
|
| It will actually mean that themes should be placed at:
|
| APPPATH/themes/ and APPPATH/modules/<module name>/themes/.
|
| NOTE: modules do not necessarily need to be in APPPATH/modules/
| as it will figure out the paths by itself. That way you can
| package your modules with themes.
| -------------------------------------------------------------------
*/
$config['twig']['theme_dir'] = 'themes';

/*
| -------------------------------------------------------------------
| Twig Cache Dir
| -------------------------------------------------------------------
|
| Path to the cache folder for compiled twig templates. It is
| relative to CodeIgniter's base directory.
| -------------------------------------------------------------------
*/
$config['twig']['cache_dir'] = APPPATH . 'cache/twig';

/*
| -------------------------------------------------------------------
| Template file extension
| -------------------------------------------------------------------
|
| This lets you define the extension for template files. It doesn't
| affect how this library deals with templates but this may help you
| if you want to distinguish different kinds of templates.
|
| For example, for CodeIgniter you may use *.html.twig template files
| and *.html.jst for js templates.
| -------------------------------------------------------------------
*/
$config['twig']['extension'] = 'html';

/*
| -------------------------------------------------------------------
| Environment options
| -------------------------------------------------------------------
|
| These are all twig-specific options that you can set. To learn more
| about each option, check the official documentation.
|
| NOTE: cache option works slightly differently than in Twig. In Twig
| you can either set the value to FALSE to disable caching, or set
| the path to where the cached files should be stored (which means
| caching would be enabled in that case). This is not entirely
| convenient if you need to switch between enabled or disabled
| caching for debugging or other reasons.
| -------------------------------------------------------------------
*/
$config['twig']['environment']['debug']               = ENVIRONMENT !== 'production';
$config['twig']['environment']['charset']             = 'utf-8';
$config['twig']['environment']['base_template_class'] = 'Twig_Template';
$config['twig']['environment']['cache']               = ENVIRONMENT !== 'production' ? $config['twig']['cache_dir'] : false;
$config['twig']['environment']['auto_reload']         = $config['twig']['environment']['debug'];
$config['twig']['environment']['strict_variables']    = false;
$config['twig']['environment']['autoescape']          = false;
$config['twig']['environment']['optimizations']       = -1;

/*
| -------------------------------------------------------------------
| Syntax Delimiters
| -------------------------------------------------------------------
|
| If you don't like the default Twig syntax delimiters or if they
| collide with other languages (for example, you use handlebars.js
| in your templates), here you can change them.
|
| Ruby erb style:
|
|   'tag_comment'   => array('<%#', '#%>'),
|   'tag_block'     => array('<%', '%>'),
|   'tag_variable'  => array('<%=', '%>')
|
| Smarty style:
|
|    'tag_comment'  => array('{*', '*}'),
|    'tag_block'    => array('{', '}'),
|    'tag_variable' => array('{$', '}'),
| -------------------------------------------------------------------
*/
$config['twig']['delimiters'] = array(
    'tag_comment'   => array('{#', '#}'),
    'tag_block'     => array('{%', '%}'),
    'tag_variable'  => array('{{', '}}')
);

/*
|--------------------------------------------------------------------------
| Auto-reigster global variables
|--------------------------------------------------------------------------
|
| Here you can list all the global variables that you want to automatically
| register them for you.
|
| NOTE: only registered functions can be used in Twig templates.
| -------------------------------------------------------------------
*/
$config['twig']['globals'] = [];

$config['twig']['filters'] = [];

/*
|--------------------------------------------------------------------------
| Auto-reigster functions
|--------------------------------------------------------------------------
|
| Here you can list all the functions that you want to automatically
| register them for you.
|
| NOTE: only registered functions can be used in Twig templates.
| -------------------------------------------------------------------
*/
$config['twig']['functions'] = [
    'base_url',
    'site_url',
    'lang',
    'form_open',
    'form_close',
    'form_label',
    'form_input',
    'form_password',
    'form_checkbox',
    'form_dropdown',
    'form_textarea',
    'form_button',
    'form_submit',
];