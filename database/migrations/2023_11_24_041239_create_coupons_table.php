<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type',['normal','product_wise','category_wise','user_wise'])->default('normal');
            $table->enum('coupon_type',['fix','persent'])->default('fix');
            $table->string('amount')->nullable();
            $table->integer('max_uses')->nullable();
            $table->text('product_id')->nullable();
            $table->text('category_id')->nullable();
            $table->integer('pro_min_amount')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->string('extra_col1')->nullable();
            $table->string('extra_col2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
