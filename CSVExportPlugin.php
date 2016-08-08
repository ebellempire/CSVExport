<?php

class CSVExportPlugin extends Omeka_Plugin_AbstractPlugin
{
	protected $_hooks = array(
		'config_form', 
		'config'
		);

	protected $_filters = array(
		'response_contexts',
		'action_contexts',
		'items_browse_per_page' );
	
	public function hookConfigForm()
	{
		require dirname(__FILE__) . '/views/admin/index.php';
	}
	
	public function hookConfig(){
		
	}
	
	public function filterItemsBrowsePerPage( $perPage ){
				
		if( $_GET["output"] == 'export-csv'){
			$perPage=null; // no pagination
		}
		
		return $perPage;
	}

	public function filterResponseContexts( $contexts )
	{
		$contexts['export-csv'] = array(
			'suffix' => 'csvexport',
			'headers' => array( 'Content-Type' => 'text/html', 'Access-Control-Allow-Origin' => '*') );
		return $contexts;
	}

	public function filterActionContexts( $contexts, $args ) {
		$controller = $args['controller'];

		if( is_a( $controller, 'ItemsController' ) )
		{
			$contexts['browse'][] = 'export-csv' ;
		}

		return $contexts;
	}
	public static function getElements($set){
		$elementSet= get_record('ElementSet',array('name'=>"$set"));
		$elements=array();
		foreach ($elementSet->getElements() as $element){
			$elements[]=$element->name;
		}	
		return $elements;	
	}	
	
	public static function arrayToTable($data){
		$isheader=true;
		echo '<table>';
		foreach($data as $row){
			echo '<tr>';
			foreach($row as $cell){
				echo $isheader ? '<th>'.$cell.'</th>' : '<td>'.$cell.'</td>';
			}
			echo '</tr>';
			$isheader = false;
		}
		echo '</table>';		
	}

}