<?php namespace Andocobo\ProjectFeatures\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateFeaturesTable extends Migration
{

    public function up()
    {
        Schema::create('andocobo_projectfeatures_features', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->index();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('features_posts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('feature_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->primary(['feature_id', 'post_id']);
        });
    }

        
    

    public function down()
    {
        Schema::dropIfExists('andocobo_projectfeatures_features');
        Schema::dropIfExists('features_posts');
    }

}
