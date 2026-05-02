<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phoneNo');
            $table->string('address');
            $table->decimal('length', 8, 2);
            $table->decimal('width', 8, 2);
            $table->decimal('chest', 8, 2);
            $table->decimal('sleeve_length', 8, 2);
            $table->decimal('shoulder', 8, 2);
            $table->decimal('neck', 8, 2);
            $table->decimal('cuff', 8, 2);
            $table->decimal('shalwarLength', 8, 2);
            $table->decimal('hem', 8, 2);
            
            // Add new columns
            $table->string('neck_type')->nullable();
            $table->decimal('neck_type_length')->nullable();
            $table->string('sleeve_type')->nullable();
            $table->decimal('sleeve_type_length')->nullable();
            $table->json('pocket')->nullable(); // Store multiple pocket values in a JSON format
            $table->string('pocket_quantity')->nullable();
            
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
