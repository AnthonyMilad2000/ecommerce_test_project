<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('temp_images', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //Stores the temporary image filename
            $table->timestamps(); //Adds created_at & updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('temp_images'); //Rollback support
    }
};
