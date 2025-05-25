<?php

use App\Models\Tag;
use App\Models\Task;
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
        Schema::create('task_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Task::class, 'task_id')->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Tag::class, 'tag_id')->constrained()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_tags');
    }
};
