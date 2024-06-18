<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('invoices', function (Blueprint $table) {
                $table->id();
                $table->integer('costumer_id');
                $table->integer('amount');
                $table->string('status'); // Billed, Paid or Void
                $table->dateTime('billed_data');
                $table->dateTime('paid_data')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('invoices');
        }
    };
