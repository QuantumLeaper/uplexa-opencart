<?php
class ModelExtensionPaymentuPlexa extends Model {
  	public function getMethod($address) {
	
		
      		$method_data = array( 
        		'code'         	=> 'uplexa',
        		'title'      	=> 'uPlexa Payment Gateway',
      		'sort_order' => '',
      		'terms' => 'by uPlexa Team'
      		);
    	
   
    	return $method_data;
  	}
}
?>
