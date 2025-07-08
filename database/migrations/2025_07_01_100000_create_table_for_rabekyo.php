<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // shops テーブル
        Schema::create('shops', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PK
            $table->string('name', 255);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps(); // created_at, updated_at
        });

        // items テーブル
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('price');
            $table->string('image_path', 500)->nullable();
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->timestamps();
        });

        // menu_sources テーブル
        Schema::create('menu_sources', function (Blueprint $table) {
            $table->id();
            $table->string('image_path', 500);
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->boolean('processed')->default(false);
            $table->timestamps();
        });

        // menu_items テーブル
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('price')->nullable();
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('source_id')->constrained('menu_sources')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menu_sources');
        Schema::dropIfExists('items');
        Schema::dropIfExists('shops');
    }
};
