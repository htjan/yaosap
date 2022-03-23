<?php
namespace htjan\yaosap\Error;

class ErrorDisplayer
{
    
    protected $error_data = array();
    
    /**
     *
     * @return multitype:
     */
    
    // TODO - Insert your code here
    public function __construct(array $error_data, string $display_mode = 'page')
    {
        $this->setErrorData($error_data);
        
        /* $display mode
         * accept "layer" and "page" values
         * */
        
        switch ($display_mode) {
            case 'page':
                $this->doWriteErrorPage();
                break;
            case 'layer':
                $this->doWriteErrorDiv();
                break;
            default:
                $this->doWriteErrorDiv();
                break;
        }
        
    }
    
    private function getErrorData()
    {
        return $this->error_data;
    }
    
    /**
     * @param multitype: $_error_data
     */
    private function setErrorData(array $_error_data)
    {
        $this->error_data = $_error_data;
    }
    
    private function doWriteErrorDiv()
    {
        // echo("<pre>");
        // var_dump($this->_error_data);
        // echo("</pre>");
        echo ("<div class=\"error\">");
        echo ("<table class=\"error\">\r\n");
        echo ("\t<tr>");
        echo ("\t\t<td>");
        
        if (isset($this->error_data[0]['title'])) {
            echo ("<b>" . $this->error_data[0]['title'] . "<b>");
        }
        
        echo ("\t\t</td>");
        echo ("\t\t<td>&nbsp;");
        echo ("\t\t</td>");
        echo ("\t</tr>\r\n");
        
        /* if error_data_text isn't NULL, display it */
        echo ("<tr>");
        echo ("\t\t<td>");
        if ($this->error_data[0]['error_text']) {
            echo ($this->error_data[0]['error_text']);
        }
        echo ("\t\t</td>");
        echo ("\t\t<td class=\"error-td-right\">");
        if (isset($this->error_data[0]['error_number'])) {
            echo ("[" . $this->error_data[0]['error_number'] . "]");
        }
        echo ("\t\t</td>");
        echo ("\t</tr>\r\n");
        
        /* if error_data_text isn't NULL, display it */
        echo ("<tr>");
        // echo ("\t\t<td>&nbsp;</td>");
        echo ("\t\t<td>");
        if (isset($this->error_data[0]['error_extra_text'])) {
            echo ($this->error_data[0]['error_extra_text']);
        }
        echo ("\t\t</td>");
        echo ("\t\t<td>&nbsp;</td>");
        echo ("\t</tr>\r\n");
        
        for ($i = 0; $i < sizeof($this->error_data); $i ++) {
            echo ("\t<tr>");
            // echo ("\t\t<td>File : </td>");
            echo ("\t\t<td>");
            if (isset($this->error_data[$i]['file'])) {
                echo ($this->error_data[$i]['file']);
            }
            echo ("\t\t</td>");
            echo ("\t\t<td class=\"error-td-right\">[");
            if (isset($this->error_data[$i]['line'])) {
                echo ($this->error_data[$i]['line']);
            }
            echo ("]</td>");
            echo ("\t</tr>\r\n");
            
            echo ("\t<tr>");
            // echo ("\t\t<td>Class : </td>");
            echo ("\t\t<td>");
            
            if (isset($this->error_data[$i]['class'])) {
                echo ("[ " . $this->error_data[$i]['class'] . " ]");
            }
            if (isset($this->error_data[$i]['object'])) {
                echo (" " . $this->error_data[$i]['object']);
            }
            if (isset($this->error_data[$i]['type'])) {
                echo ($this->error_data[$i]['type']);
            }
            if (isset($this->error_data[$i]['function'])) {
                echo ($this->error_data[$i]['function'] . "()");
            }
            
            echo ("\t\t</td>");
            echo ("\t\t<td>&nbsp;</td>");
            echo ("\t</tr>\r\n");
            
            echo ("\t<tr>");
            // echo ("\t\t<td>Variables : </td>");
            echo ("\t\t<td>");
            
            if (isset($this->error_data[$i]['args'])) {
                foreach ($this->error_data[$i]['args'] as $key => $value) {
                    echo ("[" . $key . "] : " . $value . "</br>\r\n");
                }
            }
            echo ("\t\t</td>");
            echo ("\t\t<td>&nbsp;</td>");
            echo ("\t</tr>\r\n");
        }
        echo ("</table>\r\n");
        echo ("</div>");
    }
    
    public function doWriteErrorPage(){
        
        echo ("<!DOCTYPE html>");
        echo ("<html>");
        echo ("<head>");
        echo ("<meta charset=\"UTF-8\">");
        echo ("<link rel=\"stylesheet\" href=\"/css/main.css\" type=\"text/css\">");
        echo ("<title>Page d'erreur</title>");
        echo ("<style type=\"text/css\">");
        echo ("</style>");
        echo ("</head>");
        echo ("<body>");
        
        $this->doWriteErrorDiv();
        
        echo ("</body>");
        echo ("</html>");
    }
    
    
    
}

