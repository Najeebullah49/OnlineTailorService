<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optional_products', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('uploadproduct_id'); // Foreign key
          
            $table->string('optional_picture1')->nullable();
            $table->string('optional_picture2')->nullable();
            $table->string('optional_picture3')->nullable();
            $table->string('optional_picture4')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('uploadproduct_id')
                ->references('id')
                ->on('upload_products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('optional_products');
    }
}
