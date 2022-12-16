<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });


        // Insert admin user 
        //  Admin credentials - admin:password
        DB::table('users')->insert(
            array(
                'username' => 'Manager',
                'password' => Hash::make($validated['Manager']),
            )
        );
        DB::table('users')->insert(
            array(
                'username' => 'ProductUser',
                'password' => Hash::make($validated['ProductUser']),
            )
        );
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
};
