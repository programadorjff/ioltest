<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('user_id')->unsigned();
        	$table->foreign('user_id')->references('id')->on('users');
        	$table->integer('last_updated_user_id')->unsigned();
        	$table->foreign('last_updated_user_id')->references('id')->on('users');
        	$table->integer('briefing_id')->unsigned();
        	$table->foreign('briefing_id')->references('id')->on('briefings');
            $table->date('date_budget');
            $table->integer('budget_type_id')->unsigned();
            $table->foreign('budget_type_id')->references('id')->on('budget_types');
            $table->decimal('total', 10, 2);
            $table->boolean('rejected');
            $table->mediumText('rejected_reason');
            $table->boolean('closed');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('last_updated_user_id');
            $table->index('briefing_id');
            $table->index('date_budget');
            $table->index('total');
            $table->index('rejected');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('budgets');
    }
}
