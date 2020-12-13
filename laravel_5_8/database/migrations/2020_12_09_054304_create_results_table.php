<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Application;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('EI')->nullable()->default(0);
            $table->smallInteger('SN')->nullable()->default(0);
            $table->smallInteger('TF')->nullable()->default(0);
            $table->smallInteger('JP')->nullable()->default(0);
            
            if($this->getLaravelVersion() < 5.8){
                $table->integer('quiz_id')->unsigned()->nullable();
            }else{
                $table->bigInteger('quiz_id')->unsigned()->nullable();
            }
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('set null');
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
        Schema::dropIfExists('results');
    }

    private function getLaravelVersion()
    {
        $version = Application::VERSION;
        return (float) substr($version, 0, strrpos($version, '.'));
    }
}
