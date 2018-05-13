<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Twig template engine implementation for CodeIgniter.
 * Based on Twiggy by Edmundas Kondrašovas.
 *
 * @package     CodeIgniter
 * @subpackage  Twig
 * @category    Libraries
 * @author      Cecep Prawiro <github.com/ceceprawiro>
 * @license     http://www.opensource.org/licenses/MIT
 * @version     1.0
 * @copyright   Copyright (c) 2018 Cecep Prawiro <github.com/ceceprawiro>
*/

class Twig {

    /**
     * Reference to CodeIgniter instance
     *
     * @var object
     */
    private $CI;

    /**
     * Configuration for this Twig library
     *
     * @var array
     */
    protected $config;

    /**
     * Holds for Twig_Environment Object
     *
     * @var object
     */
    protected $twig;

    /**
     * Current theme name
     *
     * @var String
     */
    protected $theme;

    public function __construct() {
        // Get reference to CodeIgniter instance
        $this->CI =& get_instance();

        // Get configuration
        $this->CI->config->load('twig');
        $this->config = $this->CI->config->item('twig');

        $this->theme = $this->config['theme'];

        // Setup default theme
        $this->setTheme();

        // Register default globals
        $this->registerGlobals();

        // Register default filters
        $this->registerFilters();

        // Register default functions
        $this->registerFunctions();

        // Setup syntax delimiters
        $this->setSyntaxDelimiters();
    }

    /**
     * Set template locations
     *
     * @param string $theme Current theme name
     *
     * @return array
     */
    private function setLocations($theme) {
        $locations = [];

        if (method_exists($this->CI->router, 'fetch_module')) {
            $module = $this->CI->router->fetch_module();

            if (! empty($module)) {
                foreach (Module::$locations as $location => $offset) {
                    // application/modules/<module name>/views/
                    if (is_dir("{$location}/{$module}/views/")) {
                        $locations[] = "{$location}/{$module}/views/";
                    }

                    // application/modules/<module name>/<theme dir>/<theme>/
                    if (is_dir("{$location}/{$module}/{$this->config['theme_dir']}/{$theme}/")) {
                        $locations[] = "{$location}/{$module}/{$this->config['theme_dir']}/{$theme}/";
                    }
                }
            }
        }

        // application/views
        $locations[] = APPPATH.'views/';

        // applications/<theme dir>/<theme>
        array_unshift(
            $locations,
            FCPATH."{$this->config['theme_dir']}/{$theme}/"
        );

        return array_unique($locations);
    }

    /**
     * Initialize Twig Environment
     *
     * @param array $locations Template locations
     *
     * @return void
     */
    private function createTwig($locations) {
        try {
            $loader = new Twig_Loader_Filesystem($locations);
        } catch (Twig_Error $e) {
            log_message('error', 'Twig: '.$e->getRawMessage());

            if (ENVIRONMENT === 'development') {
                show_error($e->getRawMessage());
            }

            exit;
        }

        try {
            $this->twig = new Twig_Environment($loader, $this->config['environment']);
        } catch (Twig_Error $e) {
            log_message('error', 'Twig: '.$e->getRawMessage());

            if (ENVIRONMENT === 'development') {
                show_error($e->getRawMessage());
            }

            exit;
        }
    }

    /**
     * Set theme
     *
     * @param string|null $theme Theme name to load
     *
     * @return Instance of this class
     */
    public function setTheme($theme = null) {
        if (is_null($theme) && $theme == $this->theme) {
            return;
        }

        $theme = is_null($theme) ? $this->theme : $theme;

        $locations = $this->setLocations($theme);
        $this->createTwig($locations);

        $this->theme = $theme;

        return $this;
    }

    /**
     * Register all globals
     */
    private function registerGlobals() {
        foreach ($this->config['globals'] as $key => $value) {
            $this->twig->addGlobal($key, $value);
        }
    }

    /**
     * Reegister all filters
     *
     * @return void
     */
    private function registerFilters() {
        foreach ($this->config['filters'] as $filter) {
            $twigFilter = new Twig_Filter($filter, $filter);
            $this->twig->addFilter($twigFilter);
        }
    }

    /**
     * Register all functions
     *
     * @return void
     */
    private function registerFunctions() {
        foreach ($this->config['functions'] as $function) {
            $twigFunction = new Twig_Function($function, $function);
            $this->twig->addFunction($twigFunction);
        }
    }

    /**
     * Set syntax delimiters
     *
     * @return void
     */
    private function setSyntaxDelimiters() {
        $this->twig->setLexer(new Twig_Lexer($this->twig, $this->config['delimiters']));
    }

    /**
     * Render template
     *
     * @param  string         $template Template to render
     * @param  array of mixed $data     The data
     *
     * @return string
     */
    public function render($template, $data = []) {
        $template = $this->twig->load("{$template}.{$this->config['extension']}");
        return $template->render($data);
    }

    /**
     * Render and display template
     *
     * @param  string         $template Template to render
     * @param  array of mixed $data     The data
     *
     * @return void
     */
    public function display($template, $data = []) {
        $template = $this->twig->load("{$template}.{$this->config['extension']}");
        $template->display();
    }

}