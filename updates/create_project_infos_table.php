<?php namespace andocobo\ProjectFeatures\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProjectInfosTable extends Migration
{

    public function up()
    {
        Schema::create('andocobo_projectfeatures_project_infos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('post_id')->nullable();
            $table->string('site_name')->nullable();
            $table->string('site_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andocobo_projectfeatures_project_infos');
    }

}
