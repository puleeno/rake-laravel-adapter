<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRakeTables extends Migration
{
    public function up()
    {
        // Bảng rake_crawled_urls
        Schema::create('rake_crawled_urls', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->string('rake_id');
            $table->string('tooth_id')->nullable();
            $table->boolean('crawled')->default(false);
            $table->boolean('skipped')->default(false);
            $table->integer('retry')->default(0);
            $table->timestamps();
        });

        // Bảng rake_resources
        Schema::create('rake_resources', function (Blueprint $table) {
            $table->id();
            $table->string('rake_id');
            $table->string('tooth_id')->nullable();
            $table->text('guid');
            $table->string('resource_type');
            $table->longText('content_text')->nullable();
            $table->string('init_hash', 64);
            $table->text('new_guid')->nullable();
            $table->string('new_type')->nullable();
            $table->boolean('imported')->default(false);
            $table->boolean('skipped')->default(false);
            $table->integer('retry')->default(0);
            $table->timestamps();
        });

        // Bảng rake_relations
        Schema::create('rake_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_id');
            $table->unsignedBigInteger('parent_id');

            $table->foreign('resource_id')->references('id')->on('rake_resources');
            $table->foreign('parent_id')->references('id')->on('rake_resources');
        });

        // Bảng rake_options
        Schema::create('rake_options', function (Blueprint $table) {
            $table->id();
            $table->string('option_name');
            $table->longText('option_value');
            $table->boolean('autoload')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rake_relations');
        Schema::dropIfExists('rake_resources');
        Schema::dropIfExists('rake_crawled_urls');
        Schema::dropIfExists('rake_options');
    }
}