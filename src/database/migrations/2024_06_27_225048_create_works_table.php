<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start')->nullable()->default(now());
            $table->time('start')->nullable()->change();
            $table->time('end')->nullable()->default(now());
            $table->time('end')->nullable()->change();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');

        Schema::table('works', function (Blueprint $table) {
            $table->timestamp('end')->nullable(false)->change();
            $table->timestamp('start')->nullable(false)->change();
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}
