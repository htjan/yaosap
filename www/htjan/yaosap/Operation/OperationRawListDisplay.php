<?php
namespace htjan\yaosap\Operation;

use htjan\yaosap\AppConfig;
use htjan\yaosap\Operation\OperationRawListData;

class OperationRawListDisplay
{
    private $operationRawListDataObj;
    private $operations;
    private $ids;
    private $tableHtmlContent;
    private $pagerHtmlContent;
    
    
    // TODO - Insert your code here
    public function __construct($order = NULL)
    {
        $this->setOperationRawListDataObj($order);
        $this->setOperationRawList();
        $this->setOperationRawIdList();
        // TODO - Insert your code here
    }
    
    /**
     * @return mixed
     */
    private function getOperationRawListDataObj()
    {
        return $this->operationRawListDataObj;
    }

    /**
     * @return mixed
     */
    public function getOperationRawList()
    {
        return $this->operations;
    }
    
    /**
     * @return mixed
     */
    public function getOperationRawIdList()
    {
        return $this->ids;
    }
    
    /**
     * @return mixed
     */
    public function getTableHtmlContent($currentPage = 0 , $maxItemPerPage = AppConfig::MAX_ITEM_PER_PAGE)
    {
        $this->setTableHtmlContent($currentPage, $maxItemPerPage);
        return $this->tableHtmlContent;
    }

    /**
     * @return mixed
     */
    public function getPagerHtmlContent($currentPage = 0 , $maxItemPerPage = AppConfig::MAX_ITEM_PER_PAGE, $maxPagesPerSlide = AppConfig::MAX_PAGES_PER_SLIDE, $order = NULL )
    {
        $this->setPagerHtmlContent($currentPage, $maxItemPerPage, $maxPagesPerSlide, $order);
        return $this->pagerHtmlContent;
    }
    
    /**
     * @param mixed $operationRawListDataObj
     */
    private function setOperationRawListDataObj($order = NULL)
    {
        $this->operationRawListDataObj = new OperationRawListData($order);
    }
    
    /**
     * @param mixed $operationRawList
     */
    private function setOperationRawList()
    {
        $this->operations = $this->operationRawListDataObj->getOperationList();
    }
    
    /**
     * @param mixed $operationRawList
     */
    private function setOperationRawIdList()
    {
        $this->ids = $this->operationRawListDataObj->getIdList();
    }
    
    /**
     * @param mixed $tableHtmlContent
     */
    private function setTableHtmlContent($currentPage, $maxItemPerPage)
    {
        
        if(is_null($this->operations))
        {
            echo("<p>No records found</p>");
            $this->tableHtmlContent .= "";
            return $this->tableHtmlContent;
        }
        
        $min_i = $currentPage*$maxItemPerPage;
        $max_i = $min_i + $maxItemPerPage;
        
        $this->tableHtmlContent = "<table>";
        $this->tableHtmlContent .="    <tr>";
        $this->tableHtmlContent .="        <td>Id <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=id_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=id_DESC\">-</a></td>";
        $this->tableHtmlContent .="        <td>Date <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=dateOpe_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=dateOpe_DESC\">-</a></td>";
        $this->tableHtmlContent .="        <td>Type <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=typeOpe_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=typeOpe_DESC\">-</a></td>";
        $this->tableHtmlContent .="        <td>Type short <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=typeOpeShort_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=typeOpeShort_DESC\">-</a></td>";
        $this->tableHtmlContent .="        <td>Label <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=label_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=label_DESC\">-</a></td>";
        $this->tableHtmlContent .="        <td>Amount <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=amount_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=amount_DESC\">-</a></td>";
        $this->tableHtmlContent .="        <td>Category <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=category_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=category_DESC\">-</a></td>";
        $this->tableHtmlContent .="        <td>Sub category <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=subCategory_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=subCategory_DESC\">-</a></td>";
        $this->tableHtmlContent .="        <td>Comments <a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=comments_ASC\">+</a>/<a href=\"".$_SERVER["SCRIPT_NAME"]."?page_name=".$_REQUEST["page_name"]."&curPage=".$currentPage."&maxItems=".$maxItemPerPage."&order=comments_DESC\">-</a></td>";
        $this->tableHtmlContent .="     </tr>";

        
        for($i = $min_i; $i < count($this->operations) && $i < $max_i; $i++)
        {
            $this->tableHtmlContent.="  <tr>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getId()."</td>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getDateOpe()."</td>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getTypeOpe()."</td>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getTypeOpeShort()."</td>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getLabel()."</td>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getAmount()."</td>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getCategory()."</td>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getSubCategory()."</td>";
            $this->tableHtmlContent.="      <td>".$this->operations[$i]->getComments()."</td>";
            $this->tableHtmlContent.="  </tr>";
        }
        $this->tableHtmlContent .= "</table>";
    }

    /**
     * @param mixed $pagerHtmlContent
     */
    private function setPagerHtmlContent($currentPage, $maxItemPerPage, $maxPagesPerSlide, $order)
    {
        if(is_null($this->ids))
        {
            echo("<p>No records found</p>");
            $this->pagerHtmlContent .= "";
            return $this->pagerHtmlContent;
        }
        
        $min_boundary   = 0;
        $max_boundary   = floor(count($this->ids)/$maxItemPerPage);
        
        // by default, min_$i = 0
        // minimum page displayed limit 
        $min_i = $min_boundary ;
        // maximum page displayed limit 
        $max_i = $max_boundary;
        
        // pages to remove to the lowest page limit, beacause there are extra page to use, because current page is closer to max page limit
        $min_page_plus = 0;
        $max_page_plus = 0 ;
        
        if($currentPage>=$maxPagesPerSlide)
        {
            $min_i=$currentPage-$maxPagesPerSlide;
        }
        else
        {
            $max_page_plus=$maxPagesPerSlide-$currentPage;
        }
        
        if($currentPage+$maxPagesPerSlide<=$max_i)
        {
            $max_i = $currentPage+$maxPagesPerSlide;
        }
        else
        {
            $min_page_plus = $max_i-$currentPage+$maxPagesPerSlide;
        }
        
        $min_i = $min_i - $min_page_plus;
        $max_i = $max_i + $max_page_plus;
        
        $this->pagerHtmlContent.="<p>&nbsp;</p><div align=\"center\">";
        // Display page 0 link
        if($currentPage>$min_boundary)
        {
            $this->pagerHtmlContent.=" <a href=\"".$_SERVER['SCRIPT_NAME']."?page_name=".$_REQUEST["page_name"]."&curPage=0&maxItems=".$maxItemPerPage."&order=".$order."\"><<</a> ";
        }
        else 
        {
            $this->pagerHtmlContent.=" << ";
        }
        // Display previous page link
        if(($min_i-1)>$min_boundary) 
        {
            $this->pagerHtmlContent.=" <a href=\"".$_SERVER['SCRIPT_NAME']."?page_name=".$_REQUEST["page_name"]."&curPage=".($min_i-1)."&maxItems=".$maxItemPerPage."&order=".$order."\"><</a> ";
        }
        else
        {
            $this->pagerHtmlContent.=" < ";
        }
        // Display page list 
        for($i = $min_i; $i <= $max_i; $i++)
        {
            if($currentPage!=$i)
            {
                $this->pagerHtmlContent.=" <a href=\"".$_SERVER['SCRIPT_NAME']."?page_name=".$_REQUEST["page_name"]."&curPage=".$i."&maxItems=".$maxItemPerPage."&order=".$order."\">".($i+1)."</a> ";
            }
            else
            {
                $this->pagerHtmlContent.=" ".($i+1)." ";
            }
            if($i <= ($max_i-1))
            {
                $this->pagerHtmlContent.=" - ";
            }
        }
        
        // Display next page link
        if(($max_i+1)<$max_boundary)
        {
            $this->pagerHtmlContent.=" <a href=\"".$_SERVER['SCRIPT_NAME']."?page_name=".$_REQUEST["page_name"]."&curPage=".($currentPage+$maxPagesPerSlide+1)."&maxItems=".$maxItemPerPage."&order=".$order."\">></a> ";
        }
        else
        {
            $this->pagerHtmlContent.=" > ";
        }
        
        // Display page 0 link
        if($currentPage<$max_boundary)
        {
            $this->pagerHtmlContent.=" <a href=\"".$_SERVER['SCRIPT_NAME']."?page_name=".$_REQUEST["page_name"]."&curPage=".$max_boundary."&maxItems=".$maxItemPerPage."&order=".$order."\">>></a> ";
        }
        else
        {
            $this->pagerHtmlContent.=" >> ";
        }
        $this->pagerHtmlContent.="</div>";
    }
}

