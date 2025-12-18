<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            // Payment details
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);

            // Payment status
            $table->enum('payment_status', [
                'pending',
                'success',
                'failed',
                'refunded'
            ])->default('pending');

            // Payment method & gateway
            $table->string('payment_method')->nullable(); // card, upi, netbanking

            // Optional references
            $table->string('service_id')->nullable();
            $table->string('receipt_number')->nullable();

            // Timestamps
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
