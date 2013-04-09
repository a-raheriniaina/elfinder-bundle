<?php

namespace Arson\elFinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller; 

/*BLOC elfinder*/
define('PATH_ELFINDER', realpath( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'Elfinder') . DIRECTORY_SEPARATOR );
include_once PATH_ELFINDER . 'elFinderConnector.class.php';
include_once PATH_ELFINDER . 'elFinder.class.php';
include_once PATH_ELFINDER . 'elFinderVolumeDriver.class.php';
include_once PATH_ELFINDER . 'elFinderVolumeLocalFileSystem.class.php';

/*END BLOC*/
 

class ElfinderController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArsonElFinderBundle:Elfinder:elfinder.html.twig');
    }
    
    public function elfinderWidgetAction($chemin)
    {
    	if ($this->container->has('profiler'))
    	{
    		$this->container->get('profiler')->disable();
    	}
    	return $this->render('ArsonElFinderBundle:Elfinder:elfinderWidget.html.twig', array('chemin' => $chemin));
    }
    
    
    public function connectAction($chemin)
    { 
    	if($this->container->hasParameter($chemin)){
    		$chemin = $this->container->getParameter($chemin);
    	}
    	
    	$opts = array(
    			'debug' => true,
    			'roots' => array(
    					array(
    							'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
    							'path'          => $chemin,         // path to files (REQUIRED)
    							'URL'           => dirname($_SERVER['PHP_SELF']). DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR . $chemin, // URL to files (REQUIRED)
    							'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL). La fonction 'access' doit se trouver dans Elfinder/callbacks
    							'tmpDir'        => '.tmp'
    					)
    			)
    	);
    
    	// run elFinder
    	$connector = new \elFinderConnector(new \elFinder($opts));
    	$connector->run(); 
    }
}
