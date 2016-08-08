<?php

class CSVExport_View_Helper_ItemCSV extends Zend_View_Helper_Abstract
{
	public function __construct()
	{
		//$this->storage = Zend_Registry::get('storage');
	}

	public function itemCSV( $item, $isExtended = false )
	{	
		
		$itemMetadata = array(
			0 	=> $item->id,
			1	=> WEB_ROOT.'/items/show/'.$item->id,
		);		
		
		$i=2;
		
		/* Dublin Core metadata */
		foreach(CSVExportPlugin::getElements('Dublin Core') as $element){
			$itemMetadata[$i] = htmlentities( implode('; ',metadata( 'item', array( 'Dublin Core', "$element" ), array( 'all' => true ) ) ));
			$i++;
		}
		
		/* Item Type metadata */
		foreach(CSVExportPlugin::getElements('Item Type Metadata') as $element){
			$itemMetadata[$i] = htmlentities( implode('; ',metadata( 'item', array( 'Item Type Metadata', "$element" ), array( 'all' => true ) ) ));
			$i++;
		}		

		// Files
		$files = array();
		$fi=0;
		foreach( $item->Files as $file )
			{
				$files[ $fi ] = $file->getWebPath( 'original' );
				$fi++;
			}
	
			if( count( $files ) > 0 ) {
				$files = implode('; ',$files);
			}else{
				$files = null;
		}
		$itemMetadata[ $i ] = $files;
		$i++;
		
		// Tags
		$itemMetadata[ $i ] = tag_string($item,null,', ');

		return $itemMetadata;
	}
}