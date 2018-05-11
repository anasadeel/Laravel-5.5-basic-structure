<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable()->index();
            $table->string('title')->nullable()->index();
            $table->string('code')->nullable()->index();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->string('teaser')->nullable();
            $table->string('metaTitle')->nullable();
            $table->string('metaDescription')->nullable();
            $table->string('keywords')->nullable();
            $table->integer('status')->default(1);
            $table->integer('deleted')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('content');
    }

}
