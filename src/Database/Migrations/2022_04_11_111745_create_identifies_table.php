<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentifiesTable extends Migration
{
    public function up(): void
    {
        Schema::create('identifies', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('code');
            $table->string('identifier')->nullable();
            $table->timestamp('expires_at');
            $table->boolean('validated')->default(false);
            $table->datetime('validated_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::drop('identifies');
    }
}
