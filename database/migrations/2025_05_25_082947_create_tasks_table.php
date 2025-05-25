<?php

use App\Models\User;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            //Define foreign key constraint
            $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnDelete();

            $table->string('title'); //required NOT NULL
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps(); //created_at & updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
