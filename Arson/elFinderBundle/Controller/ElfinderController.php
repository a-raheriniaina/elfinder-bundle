<?php

namespace Arson\elFinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller; 

/*BLOC elfinder*/
include_once dirname(__FILE__).'/../Elfinder/elFinderConnector.class.php';
include_once dirname(__FILE__).'/../Elfinder/elFinder.class.php';
include_once dirname(__FILE__).'/../Elfinder/elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).'/../Elfinder/elFinderVolumeLocalFileSystem.class.php';
include_once dirname(__FILE__).'/../Elfinder/elFinderVolumeArson.class.php';



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
    	
    	$cheminUrl = $this->container->get('templating.helper.assets')
    	->getUrl($chemin);
    	$opts = array(
    	      //  'bind' => array('upload' => 'upload'),
    			'debug' => true,
    			'roots' => array(
    					array(
    							'driver'        => 'Arson',   // driver for accessing file system (REQUIRED)
    							'path'          => $chemin,         // path to files (REQUIRED)
    							 'URL'           =>$cheminUrl,         // URL to files (REQUIRED)
    							'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL). La fonction 'access' doit se trouver dans Elfinder/callbacks
    							'tmpDir'        => $this->container->get('templating.helper.assets')->getUrl('.tmb/')
    					)
    			)
    	);
    
    	// run elFinder
    	$connector = new \elFinderConnector(new \elFinder($opts));
    	$connector->run(); 
    }
}
