<?php

namespace Config;

use CodeIgniter\Config\View as BaseView;
use CodeIgniter\View\ViewDecoratorInterface;

/**
 * @phpstan-type parser_callable (callable(mixed): mixed)
 * @phpstan-type parser_callable_string (callable(mixed): mixed)&string
 */
class View extends BaseView
{

    public $saveData = true;

    /**
     * The folder where app-specific overrides for library views can be placed.
     * This allows customization of package views.
     *
     * @var string
     */
    public $appOverridesFolder = APPPATH . 'Views/Libraries';

    /**
     * Parser Filters map a filter name with any PHP callable. When the
     * Parser prepares a variable for display, it will chain it
     * through the filters in the order defined, inserting any parameters.
     * To prevent potential abuse, all filters MUST be defined here
     * in order for them to be available for use within the Parser.
     *
     * Examples:
     *  { title|esc(js) }
     *  { created_on|date(Y-m-d)|esc(attr) }
     *
     * @var         array<string, string>
     * @phpstan-var array<string, parser_callable_string>
     */
    public $filters = [];

    /**
     * Parser Plugins provide a way to extend the functionality provided
     * by the core Parser by creating aliases that will be replaced with
     * any callable. Can be single or tag pair.
     *
     * @var         array<string, callable|list<string>|string>
     * @phpstan-var array<string, list<parser_callable_string>|parser_callable_string|parser_callable>
     */
    public $plugins = [];

    /**
     * View Decorators are class methods that will be run in sequence to
     * have a chance to alter the generated output just prior to caching
     * the results.
     *
     * All classes must implement CodeIgniter\View\ViewDecoratorInterface
     *
     * @var list<class-string<ViewDecoratorInterface>>
     */
    public array $decorators = [];
}
