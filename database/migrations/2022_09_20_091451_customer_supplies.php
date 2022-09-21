<?php
use App\Models\Query\Customer\CustomerSupply;
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
        Schema::create('customer_supplies', function (Blueprint $table) {
            $table->increments(CustomerSupply::PRIMARY_KEY);
            $table->string('id', 150)->unique();
            $table->string('customerId',150);
            $table->string('supplyId',150);
            $table->smallInteger('quantity');
            $table->bigInteger(CustomerSupply::CREATED_AT)->index();
            $table->bigInteger(CustomerSupply::UPDATED_AT)->nullable()->index();
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
        Schema::dropIfExists('customer_supplies');
    }
};
