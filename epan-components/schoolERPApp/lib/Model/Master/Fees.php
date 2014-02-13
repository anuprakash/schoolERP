<?php
namespace schoolERPApp;
class Model_Master_Fees extends \Model_Table{
	public $table='schoolERPApp/fees';
	function init(){
		parent::init();
		$this->hasOne('schoolERPApp/FeesHead','schoolERPApp/feeshead_id');
		$this->hasOne('schoolERPApp/Session','schoolERPApp/session_id');
		$this->addHook('beforeSave',$this);		

	}
	function beforeSave(){
		$categorytype=$this->add('schoolERPApp/Model_Master_Fees');
		if($categorytype->loaded()){
		$categorytype->addCondition('id','<>',$this->id);
		}
		$categorytype->addCondition('name',$this['name']);
		$categorytype->tryLoadAny();
		if($categorytype->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}
	


