<?php namespace andocobo\ProjectFeatures\Models;

use Model;

/**
 * ProjectInfo Model
 */
class ProjectInfo extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andocobo_projectfeatures_project_infos';

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
    
    public $belongsTo = [
            'post' => ['RainLab\Blog\Models\Post']
        ];

    public static function getFromPost($post)
    {
        if($post->projectInfo)
            return $post->projectInfo;

        $projectInfo = new static;

        $projectInfo->post = $post;

        $projectInfo->save();

        $post->projectInfo = $projectInfo;

        return $projectInfo;
    }
    
}