<?php namespace Andocobo\ProjectFeatures\Models;

use October\Rain\Database\Model;
use System\Classes\SettingsManager;

/**
 * Project features settings model
 *
 * @package Project Features
 * @author Andrew Coe
 *
 */
class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'andocobo_projectfeatures_settings';

    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [
        'blog_category' => 'required',
        'number_posts'    => 'required'
        
    ];

    public function __construct()
    {
        parent::__construct();

        SettingsManager::setContext('Andocobo.ProjectFeatures', 'project-settings');
    }
}