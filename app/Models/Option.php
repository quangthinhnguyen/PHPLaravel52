<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $tableName = 'options';
    
    public $timestamps = false;
    
    public $vTableName = 'Tùy chọn';
   
   /**
    * The column in table
    */
    public $columns = array(
            array('name'=>'id','type'=>'increments','vName'=>'Mã',
                'validation'=>'integer',
                'vAction'=>'index|show|edit|update'),
            array('name'=>'name','type'=>'string','vName'=>'Tên',
                'validation'=>'required|max:255',
                'vAction'=>''),
            array('name'=>'value','type'=>'longText','vName'=>'Giá trị',
                'validation'=>'required',
                'vAction'=>''),
            array('name'=>'type','type'=>'enum', 'data'=> ['text','json','number','select'],'vName'=>'Kiểu dữ liệu',
                'validation'=>'required',
                'vAction'=>''),
            array('name'=>'autoload','type'=>'enum', 'data'=> ['yes','no'],'vName'=>'Trạng thái',
                'validation'=>'required',
                'vAction'=>''),
        );
    
    
    /**
     * Get column info
     */
    public function getColumns($action = 'index'){
        $result = array();
        foreach ($this->columns as $value) {
            if(isset($value['vAction'])){
                if($value['vAction'] == ''){
                    $result[] = (object)$value;
                }else{
                    if(strpos($value['vAction'], $action) !== false){
                        $result[] = (object)$value;   
                    }   
                }    
            }
        }
        return $result;
    }
    
    public function getColumnsValidation($action = 'index'){
        $result = array();
        $data = $this->getColumns($action);
        foreach ($data as $value) {
            $result[$value->name] = $value->validation;
        }
        return $result;
    }
}
