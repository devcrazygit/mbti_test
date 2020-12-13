<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Application;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            if($this->getLaravelVersion() < 5.8){
                $table->integer('question1_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question1_id')->unsigned()->nullable();
            }
            $table->foreign('question1_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question2_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question2_id')->unsigned()->nullable();
            }
            $table->foreign('question2_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question3_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question3_id')->unsigned()->nullable();
            }
            $table->foreign('question3_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question4_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question4_id')->unsigned()->nullable();
            }
            $table->foreign('question4_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question5_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question5_id')->unsigned()->nullable();
            }
            $table->foreign('question5_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question6_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question6_id')->unsigned()->nullable();
            }
            $table->foreign('question6_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question7_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question7_id')->unsigned()->nullable();
            }
            $table->foreign('question7_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question8_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question8_id')->unsigned()->nullable();
            }
            $table->foreign('question8_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question9_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question9_id')->unsigned()->nullable();
            }
            $table->foreign('question9_id')->references('id')->on('questions')->onDelete('set null');

            if($this->getLaravelVersion() < 5.8){
                $table->integer('question10_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('question10_id')->unsigned()->nullable();
            }
            $table->foreign('question10_id')->references('id')->on('questions')->onDelete('set null');
            $table->integer('answer1')->unsigned();
            $table->integer('answer2')->unsigned();
            $table->integer('answer3')->unsigned();
            $table->integer('answer4')->unsigned();
            $table->integer('answer5')->unsigned();
            $table->integer('answer6')->unsigned();
            $table->integer('answer7')->unsigned();
            $table->integer('answer8')->unsigned();
            $table->integer('answer9')->unsigned();
            $table->integer('answer10')->unsigned();

            if($this->getLaravelVersion() < 5.8){
                $table->integer('user_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('user_id')->unsigned()->nullable();
            }
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('email');
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
        Schema::dropIfExists('quizzes');
    }
    /**
     * Get Laravel's version.
     *
     * @return float
     */
    private function getLaravelVersion()
    {
        $version = Application::VERSION;
        return (float) substr($version, 0, strrpos($version, '.'));
    }
}
