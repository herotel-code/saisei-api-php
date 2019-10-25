<?php
/*
   Original PHP library for Saisei API (https://github.com/russianryebread/saisei-api-php)
   Modified by Zac Dreyer <zac.dreyer@herotel.com>

   This library provides user friendly access to the REST API
   for Saisei.

   The library is built using PHP standard libraries.
   (no third party tools required, so it will run out of the box
   on most PHP environments).
   The wrapper functions return native PHP objects (arrays and objects),
   so working with them is easily done using built in functions.

    USAGE:

    Simply add class.Saisei.php to your PHP include path:

    require_once class.Saisei.php';
    $saisei = new SaiseiInterface('Saisei URL', 'Username', 'Password', 'Port');

*/


class SaiseiInterface {

    private $url;
    private $port;
    private $username;
    private $password;
    private $debug;
    private $url_path;

    /**
     * Class constructor accepting the instance URL, port, username, and password
     *
     * @param string $url
     * @param string $username
     * @param string $password
     * @param int    $port
     */
    public function __construct($url, $username, $password, $port = 5000, $debug = false, $url_path = '/rest/top/configurations/running') {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
        $this->debug = (bool) $debug;
        $this->url_path = $url_path;
    }


############### [START] INTERFACES #########################################################################################################
    /**
     * Gets a list of interfaces
     *
     * @param array $params
     * @return mixed
     * @link https://$url:$port/rest/top/configurations/running/interfaces
     */
    public function getInterfaces($params = array()){
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
            
        }

        return $this->GET($this->url_path . "/interfaces/" . $params_string)->asJSON($this->debug);
    }

    /**
     * Gets an interface
     *
     * @param string $iface
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/interfaces/$iface
     */
    public function getInterface($iface){
        return $this->GET($this->url_path . "/interfaces/" . $iface)->asJSON($this->debug);
    }
############### [END] INTERFACES #########################################################################################################


############### [START] HOSTS ############################################################################################################
    /**
     * Gets a list of hosts
     *
     * @param array  $params
     * @return mixed
     * @link https://$url:$port/rest/top/configurations/running/fibs/fib0/hosts/
     */
    public function getHosts($params = array()){
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
            
        }

        return $this->GET($this->url_path . "/fibs/fib0/hosts/" . $params_string)->asJSON($this->debug);
    }


    /**
     * Gets a host
     *
     * @param string $host
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/fibs/fib0/hosts/$host
     */
    public function getHost($host){
        return $this->GET($this->url_path . "/fibs/fib0/hosts/" . $host)->asJSON($this->debug);
    }


    /**
     * Update a host
     *
     * @param string $host
     * @param array  $request_body_obj
     * @return mixed
     */
    public function updateHost($host, $request_body_obj = array()){
        $url_path = $this->url_path . "/hosts/". $host;
        $request = null;
        $request = $this->PUT($url_path);
        return $request->body($request_body_obj)->asJSON($this->debug);
    }
############### [END] HOSTS ############################################################################################################


############### [START] USERS ##########################################################################################################
    /**
     * Gets a list of user groups
     *
     * @param array $params
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/user_groups
     */
    public function getUserGroups($params = array()) {
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
            
        }

        return $this->GET($this->url_path . '/user_groups/' . $params_string)->asJSON($this->debug);
    }


    /**
     * Gets a user group
     *
     * @param string $group
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/user_groups/$group
     */
    public function getUserGroup($group) {
        return $this->GET($this->url_path . '/user_groups/' . $group)->asJSON($this->debug);
    }


    /**
     * Gets a list of users
     *
     * @param array  $params
     * @return mixed
     * @link https://$url:$port/rest/top/configurations/running/users/
     */
    public function getUsers($params = array()){
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
            
        }

        return $this->GET($this->url_path . "/users/" . $params_string)->asJSON($this->debug);
    }


    /**
     * Gets a user
     *
     * @param string $user
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/users/$user
     */
    public function getUser($user) {
        return $this->GET($this->url_path . "/users/" . $user)->asJSON($this->debug);
    }


    /**
     * Upsert a user
     *
     * @param string $user
     * @param array $request_body_obj
     * @return mixed
     */
    public function upsertUser($user, $request_body_obj = array()){
        $url_path = $this->url_path . "/users/". $user;
        $request = null;
        $request = $this->PUT($url_path);
        return $request->body($request_body_obj)->asJSON($this->debug);
    }

    /**
     * Delete a user
     *
     * @param string $user
     * @return bool
     */
    public function deleteUser($user){
        $this->DELETE($this->url_path . "/users/" . $user)->asJSON($this->debug);
        return true;
    }
############### [END] USERS ######################################################################################################


############### [START] APPLICATIONS #############################################################################################
    /**
     * Gets a list of application groups
     *
     * @param array $params
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/app_groups
     */
    public function getApplicationGroups($params = array()) {
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
            
        }

        return $this->GET($this->url_path . '/app_groups/' . $params_string)->asJSON($this->debug);
    }

    /**
     * Gets an application group
     *
     * @param string $group
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/app_groups/$group
     */
    public function getApplicationGroup($group) {
        return $this->GET($this->url_path . '/app_groups/' . $group)->asJSON($this->debug);
    }


    /**
     * Gets a list of applications
     *
     * @param array $params
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/applications
     */
    public function getApplications($params = array()) {
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
            
        }

        return $this->GET($this->url_path . '/applications/' . $params_string)->asJSON($this->debug);
    }

    /**
     * Gets an application
     *
     * @param string $application
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/applications/$application
     */
    public function getApplication($application) {
        return $this->GET($this->url_path . '/applications/' . $application)->asJSON($this->debug);
    }


    /**
     * Gets a list of user applications
     *
     * @param string $user
     * @param array  $params
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/users/$user/applications
     */
    public function getUserApplications($user, $params = array()) {
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
        }

        return $this->GET($this->url_path . "/users/" . $user . '/applications/' . $params_string)->asJSON($this->debug);
    }

    /**
     * Gets a user application
     *
     * @param string $user
     * @param string $application
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/users/$user/applications/$application
     */
    public function getUserApplication($user, $application) {
        return $this->GET($this->url_path . "/users/" . $user . '/applications/' . $application)->asJSON($this->debug);
    }
############### [END] APPLICATIONS ###############################################################################################

############### [START] FLOWS ####################################################################################################
    /**
     * Gets a list of flows
     *
     * @param array $params
     * @return mixed
     * @link https://$url:$port/rest/top/configurations/running/rate_plans/
     */
    public function getFlows($params = array()){
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
            
        }

        return $this->GET($this->url_path . "/flows/")->asJSON($this->debug);
    }


    /**
     * Gets a flow
     *
     * @param string $flow
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/rate_plans/$rateplan
     */
    public function getFlow($flow) {
        return $this->GET($this->url_path . "/flows/" . $flow)->asJSON($this->debug);
    }
############### [END] FLOWS ######################################################################################################

############### [START] RATE PLANS ###############################################################################################
    /**
     * Gets a list of rate plans
     *
     * @param array $params
     * @return mixed
     * @link https://$url:$port/rest/top/configurations/running/rate_plans/
     */
    public function getRatePlans($params = array()){
        $params_string = '';
        if(count($params) > 0){
            $params_string = '?';
            foreach($params AS $key=>$value){
                $params_string .= urlencode($key)."=".urlencode($value)."&";
            }
            $params_string = rtrim($params_string, '&');
            $params_string = trim($params_string);
            
        }

        return $this->GET($this->url_path . "/rate_plans/")->asJSON($this->debug);
    }


    /**
     * Gets a rate plan
     *
     * @param string $rateplan
     * @return mixed
     * @link  https://$url:$port/rest/top/configurations/running/rate_plans/$rateplan
     */
    public function getRatePlan($rateplan) {
        return $this->GET($this->url_path . "/rate_plans/" . $rateplan)->asJSON($this->debug);
    }

    /**
     * Upsert a rate plan
     *
     * @param string $rateplan
     * @param array  $request_body_obj
     * @return mixed
     */
    public function upsertRatePlan($rateplan, $request_body_obj = array()){
        $url_path = $this->url_path . "/rate_plans/". $rateplan;
        $request = null;
        $request = $this->PUT($url_path);
        return $request->body($request_body_obj)->asJSON($this->debug);
    }

    /**
     * Delete a rate plan
     *
     * @param string $rateplan
     * @return bool
     */
    public function deleteRatePlan($rateplan){
        $this->DELETE($this->url_path . "/rate_plans/" . $rateplan)->asJSON($this->debug);
        return true;
    }
############### [END] RATE PLANS #################################################################################################

############### [START] UTILITIES ################################################################################################
    /**
     * Commit changes made to system, i.e "configuration". This includes adding or deleting data.
     *
     * @return mixed
     */
    public function commit(){
        $url_path = $this->url_path;
        $request_body_obj  = array(
            "save_partition"    => "current",
            "save_config"       => "true"
        );
        $request = null;
        $request = $this->PUT($url_path);
        return $request->body($request_body_obj)->asJSON($this->debug);
    }
############### [END] UTILITIES ##################################################################################################


################################################################################
################################################################################

    /**
     * Create GET request
     *
     * @param string $url_path
     * @return SaiseiRequest
     */
    private function GET($url_path){
        return new SaiseiRequest("GET", $this->url, $this->port, $url_path, $this->username, $this->password, array(), $this->debug);
    }
    /**
     * Create PUT request
     *
     * @param string $url_path
     * @return SaiseiRequest
     */
    private function PUT($url_path){
        return new SaiseiRequest("PUT", $this->url, $this->port, $url_path, $this->username, $this->password, array(), $this->debug);
    }
    /**
     * Create POST request
     *
     * @param string $url_path
     * @return SaiseiRequest
     */
    private function POST($url_path){
        return new SaiseiRequest("POST", $this->url, $this->port, $url_path, $this->username, $this->password, array(), $this->debug);
    }
    /**
     * Create DELETE request
     *
     * @param string $url_path
     * @return SaiseiRequest
     */
    private function DELETE($url_path){
        return new SaiseiRequest("DELETE", $this->url, $this->port, $url_path, $this->username, $this->password, array(), $this->debug);
    }
}
/**
 * API Requests class
 *
 * Helper class for executing REST requests to the Saisei API.
 *
 * Usage:
 * 	- Instantiate: $request = new SaiseiRequest('GET', 'create.../)
 *  - Execute: $request->toString();
 *  - Or implicitly execute: $request->asJSON();
 */
class SaiseiRequest {
    public $verbose;
    private $curl;
    private $url;
    private $port;
    private $username;
    private $password;
    private $url_path;

    /**
     * Request headers
     *
     * @var array
     */
    private $headers;

    /**
     * Request parameters
     *
     * @var array
     */
    private $querystrings;

    /**
     * Response body
     *
     * @var string
     */
    private $body;
    /**
     * Request initialisation
     *
     * @param string $method (GET|DELETE|POST|PUT)
     * @param string $url
     * @param string $port
     * @param string $url_path
     * @param string $username
     * @param string $password
     * @param array $headers
     * @param bool $debug
     * @throws Exception
     */
    function __construct($method, $url, $port, $url_path, $username, $password, $headers = array(), $debug = false){
        $this->curl = curl_init();
        $this->url = $url;
        $this->port = $port;
        $this->url_path = $url_path;
        $this->username = $username;
        $this->password = $password;
        $this->querystrings = array();
        $this->headers = $headers;
        $this->body = null;

        switch($method){
            case "GET":
                // GET is the default
                break;
            case "DELETE":
                $this->method("DELETE");
                break;
            case "POST":
                $this->method("POST");
                break;
            case "PUT":
                $this->method("PUT");
                break;
            default: throw new Exception('Invalid HTTP method: ' . $method);
        }
        // Have curl return the response, rather than echoing it
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        // Set up authentication.
        curl_setopt($this->curl, CURLOPT_USERPWD, $this->username . ":" . $this->password);

        // This may be useful for debugging
        if ( $debug == true) {
            curl_setopt($this->curl, CURLOPT_VERBOSE, true);
            $this->verbose = fopen('php://temp', 'w+');
            curl_setopt($this->curl, CURLOPT_STDERR, $this->verbose);
        }

        // Just assume that it's the right box, and ignore invalid SSL.
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
    }

    /**
     * Get executed request response
     *
     * @param  bool $debug
     * @throws Exception
     * @return string
     */
    public function asJSON($debug = false){

        $url =  $this->url . ':' . $this->port . $this->url_path . $this->buildQueryString();
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($this->curl);
        $errno = curl_errno($this->curl);

        if ($debug == true) {
            if ($response === FALSE) {
                printf("cUrl error (#%d): %s<br>\n", curl_errno($this->curl),
                    htmlspecialchars(curl_error($this->curl)));
            }

            rewind($this->verbose);
            $verboseLog = stream_get_contents($this->verbose);

            echo "<p><h3>Verbose information:</h3><pre>", htmlspecialchars($verboseLog), "</pre></p>";
            echo "<p><h3>Error</h3>" . $errno . "</p>";
            echo "<p><h3>Information</h3>";
            print_r (curl_getinfo($this->curl));
            echo "</p>";

        }


        if($errno != 0){
            throw new Exception("HTTP Error (" . $errno . "): " . curl_error($this->curl));
        }

        // $status_code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        // if(!($status_code == 200 || $status_code == 201 || $status_code == 202)){
        //   throw new Exception($response);
        // }
        return $response;
    }
    /**
     * Return decoded JSON response
     *
     * @throws Exception
     * @return mixed
     */
    public function asObject(){
        $data = json_encode($this->asJSON());
        $errno = json_last_error();
        if($errno != JSON_ERROR_NONE){
            throw new Exception("Error encountered encoding JSON: " . json_last_error_msg());
        }
        return $data;
    }
    /**
     * Add data to the current request
     *
     * @param mixed $obj
     * @throws Exception
     * @return SaiseiRequest
     */
    public function body($obj){
        $data = json_encode($obj);
        $errno = json_last_error();
        if($errno != JSON_ERROR_NONE){
            throw new Exception("Error encountered encoding JSON: " . json_last_error_message());
        }
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        $this->headers[] = "Content-Type: application/json";

        return $this;
    }
    /**
     * Set request method
     *
     * @param string $method
     * @return SaiseiRequest
     */
    private function method($method){
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        return $this;
    }
    /**
     * Add query parameter to the current request
     *
     * @param string $name
     * @param mixed $value
     * @return SaiseiRequest
     */
    public function queryParam($name, $value){
        // build the query string for this name/value pair
        $querystring = http_build_query(array($name => $value));
        // append it to the list of query strings
        $this->querystrings[] = $querystring;
        return $this;
    }
    /**
     * Build query string for the current request
     *
     * @return string
     */
    private function buildQueryString(){
        if(count($this->querystrings) == 0){
            return "";
        }
        else{
            $querystring = "?";
            foreach($this->querystrings as $index => $value){
                if($index > 0){
                    $querystring .= "&";
                }
                $querystring .= $value;
            }
            return $querystring;
        }
    }
}
