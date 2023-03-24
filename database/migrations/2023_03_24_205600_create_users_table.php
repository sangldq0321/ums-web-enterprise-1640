<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('userID');
            $table->string('username')->unique();
            $table->string('fullname');
            $table->string('password');
            $table->foreignId('roleID')->constrained('roles', 'roleID')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('isPassReset');
            $table->timestamps();
        });
        DB::table('users')->insert([
            array(
                'userID' => '1',
                'username' => 'ldqs',
                'fullname' => 'Le Do Quang Sang',
                'password' => '$2a$10$Dlaw82.n/g0Ld0cnWlWcEOqwi8LSMuknh7yQi.BS5DxhylyisfBeG',
                'roleID' => '1',
                'isPassReset' => '0'
            )
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
