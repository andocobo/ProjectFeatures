<?php namespace Andocobo\ProjectFeatures\Components;

use Andocobo\ProjectFeatures\Models\Features;
use Andocobo\ProjectFeatures\Models\Settings as Settings;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Category;

use Cms\Classes\ComponentBase;

class FeaturesComponent extends ComponentBase
{
    /**
     * This holds the posts we want to see
     * @var collection
     */
    public $posts;

    /**
     * This holds the projectinfo for each fost
     * @var array
     */
    public $projectInfo;

    /**
     * This property holds all the features for each project
     * @var array
     */
    public $featureList;

    public function componentDetails()
    {
        return [
            'name'        => 'Features Component',
            'description' => 'Database driven project features list'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $number = Settings::get('number_posts', 3);
        $category = Category::where('slug', '=', Settings::get('blog_category', 'web-showcase'))->first();
        $category_id = $category->id;

        $this->posts = Category::find($category_id)->posts()->take($number)->get();

        foreach($this->posts as $post)
        {
            $this->featureList[$post->id] = $post->features;
            $this->projectInfo[$post->id] = $post->projectInfo;
        }
    }
}