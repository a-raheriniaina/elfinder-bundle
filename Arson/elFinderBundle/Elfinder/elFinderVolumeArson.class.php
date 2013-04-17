<?php 
use Doctrine\Common\Util\Inflector as Doctrine_Inflector;

class elFinderVolumeArson extends elFinderVolumeLocalFileSystem {
	
	public function upload($fp, $dst, $name, $tmpname) {
		
		$info = pathinfo($name);
		$extension = '.'. $info['extension'];
		$fileName= $info['filename'];
		$name = Doctrine_Inflector::urlize($fileName);
		$name.=$extension;
		
		return parent::upload($fp, $dst, $name, $tmpname);
		
	}
	
} 
