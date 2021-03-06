<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    var $model;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->model = new App\Models\Option();
        
        Schema::create($this->model->tableName,function(Blueprint $table){
            foreach ($this->model->getColumns() as $value) {
                $action = $value->type;
                switch ($action) {
                    case 'enum': $table->$action($value->name, $value->data); break;
                    default: $table->$action($value->name); break;
                }
            }
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->model->tableName);
    }
}
