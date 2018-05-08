<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('sport_id')->nullable();
            $table->json('socials')->nullable();
            $table->string('website')->nullable();
            $table->float('avg_cost')->default(0);
            $table->string('age_range')->nullable();
            $table->text('about')->nullable();
            $table->text('coaching_styles')->nullable();
            $table->text('coaching_experiences')->nullable();
            $table->text('athlete_experiences')->nullable();
            $table->boolean('disability')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('set null');
        });

        Schema::create('coach_sport_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('coach_id');
            $table->unsignedInteger('sport_meta_id');

            $table->foreign('coach_id')->references('id')->on('coach_profiles')->onDelete('cascade');
            $table->foreign('sport_meta_id')->references('id')->on('sport_metas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coach_sport_meta');
        Schema::dropIfExists('coach_profiles');
    }
}
