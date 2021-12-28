<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_no');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('room_id');
            $table->string('booking_date');
            $table->string('time');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();

            // $table->string('user_name',191);
            // $table->string('email',191);
            // $table->string('phone_no',191);
            // $table->text('address');
            // $table->unsignedBigInteger('room_id');
            // $table->string('booking_date',191);
            // $table->string('time',191);
            // $table->string('status',191);
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
