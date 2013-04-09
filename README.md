elfinder-bundle
===============
I - INTRODUCTION

    This bundle was created to make easy the integration, configuration of elfinder in symfony2.

II - INSTALLATION

    1- copy the directory 'Arson' to vendor.
    
    2- add the following namespace :
        'Arson\\elFinderBundle'      => $vendorDir . '/'
        
    3- add the following code to your .httaccess
         RewriteRule (.*)\.\.\.\.(.*) $1/../../$2
    
    4- In AppKernerl.php, register the bundle 
        new Arson\elFinderBundle\ArsonElFinderBundle(),
     
    5- add ArsonElfinder route to app/config.yml
         ArsonElFinder:
            resource: "@ArsonElFinderBundle/Resources/config/routing.yml"
     
    6- add some Url to your parameters, for example:
        parameters:
            path_to_pdf: 'uploaded/pdf/'
            
        NB: the url is based on 'web' folder. 'uploaded' directory must exist in web. (web/uploaded/)
        NB: this step (6) is only needed if you want to hide the path for client. without this, you il need to do that:
        
        filebrowserBrowseUrl : "{{ path('arson_el_finder_widget', { chemin : 'uploaded/pdf' }) }}" , instead of
        filebrowserBrowseUrl : "{{ path('arson_el_finder_widget', { chemin : 'path_to_pdf' }) }}"             
         
    7- Under windows, don't forget to activate the fileinfo extension by uncommenting the line extension=php_fileinfo.dll in php.ini
