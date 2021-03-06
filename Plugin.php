<?php namespace andocobo\ProjectFeatures;

use System\Classes\PluginBase;
use RainLab\Blog\Models\Post as PostModel;
use RainLab\Blog\Controllers\Posts as PostsController;
use andocobo\ProjectFeatures\Models\Feature as FeatureModel;
use andocobo\ProjectFeatures\Models\ProjectInfo as ProjectInfoModel;

/**
 * ProjectFeatures Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['RainLab.Blog'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    
    public function pluginDetails()
    {
        return [
            'name'        => 'Project Features',
            'description' => 'Add project features tab to blog admin page.',
            'author'      => 'andocobo',
            'icon'        => 'icon-asterisk'
        ];
    }

    public function registerComponents()
    {
        return [
            'andocobo\ProjectFeatures\Components\FeaturesComponent' => 'projectFeatures'
        ];
    }

    public function registerPageSnippets()
    {
        return [
            'andocobo\ProjectFeatures\Components\FeaturesComponent' => 'projectFeatures'
        ];
    }

    public function registerPermissions()
    {
        return [
            'andocobo.projectfeatures.add_feature' => ['label' => 'Add new features']
        ];
    }

    public function registerSettings()
    {
        return [
            'project-settings' => [
                'label'       => 'Project Features settings',
                'description' => 'Manage the web showcase page',
                'category'    => 'Project Features',
                'icon'        => 'icon-asterisk',
                'class'       => 'andocobo\ProjectFeatures\Models\Settings',
                'order'       => 500,
                'keywords'    => 'projects features blog'
            ]
        ];
    }

    public function boot()
    {
        $optionsList = array();
        $postFeatureIds = array();

        PostModel::extend(function($model)
        {
            $model->belongsToMany['features'] = ['andocobo\ProjectFeatures\Models\Feature', 'table' => 'features_posts'];
            $model->hasOne['projectInfo'] = ['andocobo\ProjectFeatures\Models\ProjectInfo', 'table' => 'andocobo_projectfeatures_project_infos'];
        });

        PostsController::extendFormFields(function($form, $model, $context)
        {
            if(!$model instanceof PostModel)
                return;

            if(!$model->exists)
                return;

            FeatureModel::getFromPost($model);
            ProjectInfoModel::getFromPost($model);

            $form->addSecondaryTabFields([
                'features' => ['label' => 'Features', 'tab' => 'Project Information', 'type' => 'relation'],
                'projectInfo[site_name]' => ['label' => 'Site Name', 'tab' => 'Project Information', 'comment' => 'Text you want in the link to the site'],
                'projectInfo[site_url]' => ['label' => 'Site URL', 'tab' => 'Project Information',  'comment' => 'URL to the site. Do not include the "http://" part']
                
                ]
            );
        });

        // Add sidebar menu items for features
        \Event::listen('backend.menu.extendItems', function($manager)
        {
           $manager->addSideMenuItems('RainLab.Blog', 'blog', [
                'projectFeatures' => [
                    'label'       => 'Project Features',
                    'icon'        => 'icon-asterisk',
                    'code'        => 'projectFeatures',
                    'owner'       => 'RainLab.Blog',
                    'url'         => \Backend::url('andocobo/projectfeatures/featurescontroller')
                ],
            ]);

        });


    }
}
