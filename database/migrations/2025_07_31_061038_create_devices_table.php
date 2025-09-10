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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_name');
            $table->string('device_model')->nullable();
            $table->text('device_description')->nullable();
            $table->string('device_serial_number')->unique();
            $table->string('device_property_number')->unique();
            $table->date('device_delivery_date');
            $table->date('device_warranty_expiration_date');
            $table->float('device_acquisition_cost');
            $table->text('device_remarks')->nullable();
            $table->date('device_deployment_date')->nullable();
            $table->foreignId('end_user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('device_type_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('status_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('arrangement_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->index('end_user_id');
            $table->index('device_type_id');
            $table->index('brand_id');
            $table->index('supplier_id');
            $table->index('status_id');
            $table->index('arrangement_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
