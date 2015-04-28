<?php namespace andocobo\ProjectFeatures\Models;

use Model;

/**
 * Feature Model
 */
class Feature extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andocobo_projectfeatures_features';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    
    public $belongsToMany = [
        'posts' => ['RainLab\Blog\Models\Post', 'table' => 'features_posts']
    ];

    public static function getFromPost($post)
    {
        if($post->features)
            return $post->features;

        $features = new static;

        $features->post = $post;

        $features->save();

        $post->features = $features;

        return $features;
    }
    

}