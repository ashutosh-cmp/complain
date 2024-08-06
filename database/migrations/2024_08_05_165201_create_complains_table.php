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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            // $table->enum('complain_type', ['type1', 'type2', 'type3']);
            // $table->foreignId('department_id')->constrained('departments')->restrictOnDelete();
            // $table->foreignId('subdepartment_id')->constrained('subdepartments')->restrictOnDelete();
            // $table->string('complain_short_desc');
            // $table->longText('complain_desc');
            // $table->boolean('status')->default(1);
            // $table->timestamp('complaint_reg_date');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
