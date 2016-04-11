<?php

namespace VojtaSvoboda\Faq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateFaqsTable
 *
 * @package VojtaSvoboda\Faq\Updates
 */
class CreateFaqTable extends Migration
{
    public $table_name = 'vojtasvoboda_faq_faqs';

    public function up()
    {
        Schema::create($this->table_name, function ($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name', 300)->nullable();
            $table->text('text')->nullable();
            $table->smallInteger('sort_order')->nullable();
            $table->boolean('enabled')->default(true);

            $table->timestamps();
            $table->softDeletes();
        } );
    }

    public function down()
    {
        Schema::drop($this->table_name);
    }

}