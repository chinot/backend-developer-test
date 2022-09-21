<?php
use App\Models\Query\Supply\Supply;
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
        Schema::create(Supply::TABLE_NAME, function (Blueprint $table) {
            $table->increments(Supply::PRIMARY_KEY);
            $table->string('id', 150)->unique();
            $table->string('supply', 255);
            $table->smallInteger('points');
            $table->bigInteger(Supply::CREATED_AT)->index();
            $table->bigInteger(Supply::UPDATED_AT)->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Supply::TABLE_NAME);
    }
};
