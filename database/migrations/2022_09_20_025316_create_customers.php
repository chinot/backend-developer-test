<?php
use App\Models\Query\Customer\Customer;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments(Customer::PRIMARY_KEY);
            $table->string('id', 150)->unique();
            $table->string('name', 255);
            $table->string('gender', 255);
            $table->smallInteger('age');
            $table->smallInteger('status')->default('1');
            $table->bigInteger(Customer::CREATED_AT)->index();
            $table->bigInteger(Customer::UPDATED_AT)->nullable()->index();
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
        Schema::dropIfExists('customers');
    }
};
