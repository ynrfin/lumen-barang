<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdCategoriesToBarangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_categories')->after('deskripsi')->nullable(true)->default(null);
            $table->index('id_categories');
            $table->foreign('id_categories')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign('barangs_id_categories_foreign');
            $table->dropIndex('barangs_id_categories_index');
            $table->dropColumn('id_categories');
        });
    }
}
