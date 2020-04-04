<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('personal_code', 11);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('phone', 255);
            $table->date('birth_date');
            $table->decimal('balance', 12, 2)->default(0.00);
            $table->string('bank_account', 34);
            $table->tinyInteger('payment_type');
            $table->boolean('confirmed')->default(false);
            $table->boolean('admin')->default(false);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('personal_code');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('birth_date');
            $table->dropColumn('balance');
            $table->dropColumn('bank_account');
            $table->dropColumn('payment_type');
            $table->dropColumn('confirmed');
            $table->dropColumn('admin');
            });
    }
}
