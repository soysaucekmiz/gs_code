<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id'); // アイテムID
            $table->integer('user_id'); // 出品者のユーザーID
            $table->string('item_name'); // アイテム名
            $table->string('item_comment'); // 一言（アイテムに付随？ユーザーに付随？）
            $table->string('item_description'); // アイテム説明
            $table->integer('item_price'); // アイテム単価
            $table->string('item_cov_img'); // アイテムカバー写真
            $table->string('item_img1'); // アイテムイメージ写真1
            $table->string('item_img2'); // アイテムイメージ写真2
            $table->string('item_img3'); // アイテムイメージ写真3
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
        Schema::dropIfExists('items');
    }
}
