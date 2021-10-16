<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsPagesTrixUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carlson_nova_simple_content_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title');
            $table->text('body');
            $table->string('slug')->unique();
            $table->string('featured_image_url')->nullable();
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('hero_image_url')->nullable();
            $table->string('post_type')->default('blog')->nullable();
            $table->dateTimeTz('published_on')->nullable();
            $table->boolean('published')->default(false);
        });

        Schema::create('carlson_nova_simple_content_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->text('body');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('slug')->unique();
            $table->string('hero_image_url')->nullable();
        });

        if (!Schema::hasTable('nova_pending_trix_attachments')) {
            Schema::create('nova_pending_trix_attachments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('draft_id')->index();
                $table->string('attachment');
                $table->string('disk');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('nova_trix_attachments')) {
            Schema::create('nova_trix_attachments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('attachable_type');
                $table->unsignedInteger('attachable_id');
                $table->string('attachment');
                $table->string('disk');
                $table->string('url')->index();
                $table->timestamps();

                $table->index(['attachable_type', 'attachable_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carlson_nova_simple_content_posts');
        Schema::dropIfExists('carlson_nova_simple_content_pages');

        // Don't clean up the trix_attachments tables because they may have been previously installed
    }
}
