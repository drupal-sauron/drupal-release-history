<?php

namespace Sauron\UpdatesDrupalOrg\ReleaseHistory;

use GuzzleHttp\Client;

/**
 * ReleaseHistoryClient retrieves module releases through
 * updates.drupal.org webservice.
 * Releases history can be fetched by module name and core version.
 */
class ReleaseHistoryClient
{
    /**
     * @var string Webservice endpoint
     */
    private $baseUrl = 'https://updates.drupal.org/release-history/';
    
    /**
     * @var GuzzleHttp\Client HTTP client used to query WS
     */
    protected $httpClient = NULL;
    
    /**
     * Initialize a new ReleaseHistoryClient by creating
     * a new instance of GuzzleHttp\Client
     */
    public function __construct() 
    {
        $this->httpClient = new Client([
            'base_url' => $this->baseUrl
        ]);
    }
    
    /**
     * Fetch releases according to given module and core version
     *
     * @param string $moduleName name of the module
     * @param string $coreVersion the core version all|8.x|7.x|6.x|5.x|4.x
     *
     * @return array xml body response as a associative array     
     */
    public function getReleases($moduleName, $coreVersion)
    {
        $request = $this->httpClient->get(['{module_name}/{core_version}', 
            ['module_name' => $moduleName, 'core_version' => $coreVersion]]);
        
        if ($request->getStatusCode() != 200) {
            throw new \Exception(sprintf('Status code was not OK. %d returned instead.', $request->getStatusCode()));
        }
        
        $response   = (string) $request->getBody();
        return $this->xmlToArray($response);
    }
    
    /**
     * Quick'n dirty trick to convert an xml content as an array
     * it does the job
     * 
     * @param string $xmlContent the xml content to convert
     
     * @return an array representation of given xml content
     */    
    protected function xmlToArray($xmlContent)
    {
        $xml = simplexml_load_string($xmlContent);
        return json_decode(json_encode((array) $xml), 1);
    }
}
