<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('urls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable()->index();
            $table->integer('type_id')->nullable()->index();
            $table->string('key')->nullable()->index();
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
        Schema::dropIfExists('urls');
    }

}
