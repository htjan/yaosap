<?php
namespace htjan\yaosap\HttpRequest;

#use htjan\yaosap\AppConfig;

/* TODO
 * Integrate ssl infos in setContext()
 * Choose to extract doWrite() from __construct() or keep it
 *      Create a distinct doWrite() function is cleaner but object needs to be created then doWrite needs to be called.2 code lines
 */

class HttpRequestManager
{

    /* Parameter variables */
    private $_url;

    private $_method;

    private $_data;

    /* Internal variables */
    private $_options;

    private $_context;

    private $_response;

    public function __construct($_url, $_method, $_data)
    {
        AppConfig::main();
        $this->setMethod($_method);
        $this->setData($_data);
        $this->setUrl($_url);

        $this->setOptions();
        $this->setContext();
        $this->setResponse();
        
    }

    private function getUrl()
    {
        return $this->_url;
    }

    private function getMethod()
    {
        return $this->_method;
    }

    private function getData()
    {
        return $this->_data;
    }

    private function getOptions()
    {
        return $this->_options;
    }

    private function getContext()
    {
        return $this->_context;
    }

    public function getResponse()
    {
        if ($this->_response !== false) {
            return ($this->_response);
        } else {
            echo ('<p align="center">ERROR : ' . AppConfig::ERROR_MESSAGE[1000] . '</p>');
            return false;
        }
    }

    // TODO Change error to an ErrorManager Object
    private function setUrl($_url)
    {
        if (! filter_var($_url, FILTER_VALIDATE_URL)) {
            echo ('<p>ERROR : ' . AppConfig::ERROR_MESSAGE[9] . '</p>');
            return false;
        }
        
        /* We admit that if no method is defined, GET will be used by default */
        if ($this->_method == 'POST') {
            $this->_url = $_url;
        } else {
            $this->_url = $_url . '?' . http_build_query($this->_data);
        }
    }

    // TODO Change error to an ErrorManager Object
    /* We admit that if no method is defined, GET will be used by default */
    private function setMethod($_method)
    {
        if ($_method == 'POST' ) {
            $this->_method = $_method;
        } else {
            $this->_method = 'GET';
            return false;
        }
    }

    private function setData($_data)
    {
        if (is_array($_data) || is_null($_data)) {
            $this->_data = $_data;
        } else {
            echo ('<p>ERROR : ' . AppConfig::ERROR_MESSAGE[10] . '</p>');
            return false;
        }
    }
    
    /* TODO
     * Add https context options
        $contextOptions = array(
            'ssl' => array(
                'verify_peer'   => true,
                'cafile'        => __DIR__ . '/cacert.pem',
                'verify_depth'  => 5,
                'CN_match'      => 'secure.example.com'
            )
        );
     */
    private function setOptions()
    {
        /* Context options only depend on the chosen http method in AppConfig parameters. */
        /* Never use 'http in options, otherway, $data won't be transmitted to the other page */
        /* See */
        if ($this->_method == 'POST') {
            $this->_options = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n"
                )
            );
        } else {
            $this->_options = array(
                'http' => array(
                    'method' => 'GET',
                    'header' => "Content-type: text/html;\r\n"
                )
            );
        }
        
    }

    private function setContext()
    {
        if (! ($this->_context = stream_context_create($this->_options))) {
            echo ('<p>ERROR : ' . AppConfig::ERROR_MESSAGE[11] . '</p>');
        }
    }

    private function setResponse()
    {
        /* Returns a string containing the http response */
        if (! ($this->_response = file_get_contents($this->_url, false, $this->_context))) {
            echo ('<p>ERROR : ' . AppConfig::ERROR_MESSAGE[12] . '</p>');
        }
    }

    
}

