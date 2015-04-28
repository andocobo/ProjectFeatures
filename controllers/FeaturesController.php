<?php namespace andocobo\ProjectFeatures\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Features Controller Back-end Controller
 */
class FeaturesController extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('RainLab.Blog', 'blog', 'projectFeatures');
    }
}