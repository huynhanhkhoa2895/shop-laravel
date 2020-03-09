<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER insert_group_urlrewrite 
            AFTER INSERT on `group`
            FOR EACH ROW
            BEGIN
            INSERT INTO url_rewrite
            SET
            `table` = 'group',
            `origin` = NEW.`id`,
            `url` = NEW.`route`,
            `type` = 'category';
            END;
            CREATE TRIGGER insert_category_urlrewrite 
            AFTER INSERT on `category`
            FOR EACH ROW
            BEGIN
            INSERT INTO url_rewrite
            SET
            `table` = 'category',
            `origin` = NEW.`id`,
            `url` = NEW.`route`,
            `type` = 'category';
            END;
            CREATE TRIGGER insert_brand_urlrewrite 
            AFTER INSERT on `brand`
            FOR EACH ROW
            BEGIN
            INSERT INTO url_rewrite
            SET
            `table` = 'brand',
            `origin` = NEW.`id`,
            `url` = NEW.`route`,
            `type` = 'category';
            END;
            CREATE TRIGGER insert_product_urlrewrite 
            AFTER INSERT on `product`
            FOR EACH ROW
            BEGIN
            INSERT INTO url_rewrite
            SET
            `table` = 'product',
            `origin` = NEW.`id`,
            `url` = NEW.`route`,
            `type` = 'product';
            END;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS insert_group_urlrewrite;
            DROP TRIGGER IF EXISTS insert_category_urlrewrite;
            DROP TRIGGER IF EXISTS insert_brand_urlrewrite;
            DROP TRIGGER IF EXISTS insert_product_urlrewrite;
        ");
    }
}
