<?php

//namespace 	htjan\yaosap;

/* Include Composer autoloader if not already done.
 * Needs a symbolic link to composer in YAOSSA root/html directory to composer root directory
 */
use         htjan\yaosaa\ctl\Initializer;
use 		htjan\yaosap\ctl\MonthCalendar    as MonthCalendar ;
use 		htjan\yaosap\mdl\AppConfig        as AppConfig;

require_once ( $_SERVER['CONTEXT_DOCUMENT_ROOT'].'cls/ctl/Initializer.php' );
$initializer    = new Initializer();
$app_config     = $initializer->getParameters();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Test</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Bluefish 2.2.10" />
	<link type="image/x-icon" rel="icon" href="/favicon.ico" />
	<link type="text/css" rel="stylesheet" media="all" href="/css/main.css" />
</head>
<body>


<?php


// Parse pdf file and stock content in a variable $pdf_content.
$pdf_content            = file_get_contents($app_config["YAOSAP_IMPORT_IN_DIR"]."RLV_CHQ_300040170400000113109_20180820.pdf");
$pdf_content            = preg_replace('/\t/', ' ', $pdf_content);

/*Extract compressed data*/
$zdata                  = array();

$data_len               = strlen($pdf_content);
$data                   = $pdf_content;

$ini_word               = "stream";
$end_word               = "endstream";

$ini_pos                = 0;
$end_pos                = $data_len;
$offset                 = 0;

while ( $ini_pos < $end_pos ){
    
    //substr ( string $string , int $offset [, int|null $length = null ] ) : string
    //$current_content        = substr($pdf_content, $current_offset_position);
    
    //strpos ( string $haystack , string $needle [, int $offset = 0 ] )
    $ini_pos            = strpos($data, $ini_word, $offset);
    $end_pos            = strpos($data, $end_word, $data_len);
    
    $sub_len            = $end_pos - $ini_pos;
    
    $zdata[$i]["ini"]   = $ini_pos;
    $zdata[$i]["data"]  = substr($data, $ini_pos, $sublen);
    
    $offset             = $end_pos;
    
    $i++;
}

/*
function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0)
        return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
}
*/

echo ("<p> Nombre de matches : ".count($stream_data)."</p>");

echo ("<p> Stream data : ".$stream_data."</p>"); 

echo ("<hr>");

echo ("<pre>".$pdf_content."</pre>");




// $compressed_data_array  = array();
// $compressed_data_regex  = '/stream(\S\s)[^\x00-\x7F]*endstream/m';
//preg_match_all ( string $pattern , string $subject [, array &$matches = null [, int $flags = PREG_PATTERN_ORDER [, int $offset = 0 ]]] ) : int|false|null
// preg_match_all($compressed_data_regex, $pdf_content, $compressed_data_array);

// echo ("<p>Nombre de streams : ".sizeof($compressed_data_array)."</p>");

// echo ("<p> Compressed data array : ".print_r($compressed_data_array)."</p>");










// Search compressed binary data in pdf
// $searchstart            = 'stream';
// $searchend              = 'endstream';

// $pos = 0;
// $pos2 = 0;
// $startpos = 0;


echo ("<pre>".$pdf_content."</pre>");

exit;

// Variable containg the data account array.
$account_data[]         = array();
$iban_regex             = '/^IBAN[\s\S]*:[\s\S]*[a-zA-Z]{2}[0-9]{2} [0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4} [0-9]{3}$/m';
$bic_regex              = '/^BIC[\s\S]*:[\s\S]*[a-zA-Z]{11}$/m';

    
//RIB
$rib_regex              = '/^RIB[\s\S]*:[\s\S]*[0-9]{5} [0-9]{5} [0-9]{11} [0-9]{2}$/m';
$rib_count 		        = preg_match ( $rib_regex , $pdf_content , $rib_res);
$account_data["rib"]    = trim (substr ( $rib_res[0] , 5 ) );

//IBAN
$iban_count 		    = preg_match ( $iban_regex , $pdf_content , $iban_res);
$account_data["iban"]   = trim (substr ( $iban_res[0] , 0 ) );

//BIC
$bic_count 		        = preg_match ( $bic_regex , $pdf_content , $bic_res);
$account_data["bic"]	= trim (substr ( $bic_res[0] , 5 ) );


/* Recherche des date du relevé : pdf -> nomde variable : Account statement accnt_stmt & as
 *  On ne prend que le premier, celui de la première page : preg_match au lieu de preg_match_all. Les autres sont identiques
 *  du 31 octobre 2012 au 18 novembre 2012
 */
$mo_cal			= new Monthclendar();
$month_calendar = $mo_cal->getLabelList();
unset($mo_cal);

//^[\s\S]*du[\s\S]*[0-3][0-9][\s\S]*(janvier|février|mars|avril|mai|juin|juillet|août|septembre|octobre|novembre|décembre)[\s\S]*2[0-9]{3}[\s\S]*au[\s\S]*[0-3][0-9][\s\S]*(janvier|février|mars|avril|mai|juin|juillet|août|septembre|octobre|novembre|décembre)[\s\S]*2[0-9]{3}[\s\S]*$


$dates_regex = '/^[\s\S]*du[\s\S]*[0-3][0-9][\s\S]*('.implode("|",$month_calendar).')[\s\S]*2[0-9]{3}[\s\S]*au[\s\S]*[0-3][0-9][\s\S]*('.implode("|",$month_calendar).')[\s\S]*2[0-9]{3}[\s\S]*$/mi';
$count = preg_match ( $dates_regex , $pdf_content , $dates_arr_raw);

echo ("<pre>");
print_r($dates_arr_raw);
echo ("</pre>");


// la chaine de date est contenue dans $dates_raw[0]. On remplace la valeur de la variable par un tableau à deux valeur : Date de début et date de fin.
// Suppression de "du" et du "au"
$dates_arr_raw[0] = str_replace ( "du ", "", $dates_arr_raw[0] );
$dates_arr_raw[0] = str_replace (" au ", " ", $dates_arr_raw[0] );

/* Explosion de la chaîne avec " au ", qui sépare les deux dates.
 * Explosion des dates avec " " stockant ainsi les données de dates dans un tableau
 * Début :
 * 		jour arr[0]
 * 		mois arr[1]
 * 		année arr[2]
 * Fin :
 *		jour arr[3]
 * 		mois arr[4]
 * 		année arr[5]
 */
$dates_arr_raw = explode(" ", $dates_arr_raw[0]);

// remplacement du libellé du mois par le nombre correspondant.
$cls_mc			= new MonthCalendar();
$month_calendar = $cls_mc->getLabelList();
$dates_arr_raw[1]	= 	$cls_mc->getNumFromLabel($dates_arr_raw[1]);
$dates_arr_raw[4]	=	$cls_mc->getNumFromLabel($dates_arr_raw[4]);
unset($mo_cal);
//~ foreach ($month_calendar as $k => $val) {

	//~ if ( $val == $dates_arr_raw[1] ) {
		//~ $dates_arr_raw[1] = $k;
	//~ }
	//~ if ( $val == $dates_arr_raw[4] ) {
		//~ $dates_arr_raw[4] = $k;
	//~ }
//~ }

// Construction des dates du relevé
$date = array();
$date["first"] 	= 	new \DateTime();
$date["first"] 	-> 	setDate( $dates_arr_raw[2], $dates_arr_raw[1], $dates_arr_raw[0] );
$date["last"] 	= 	new \DateTime();
$date["last"] 	-> 	setDate( $dates_arr_raw[5], $dates_arr_raw[4], $dates_arr_raw[3] );



/* Dans tous les relevés, l'année de début du relevé est identique à l'année de fin, SAUF pour le relevé du mois de décembre.
 * Ce fichiers est sur deux années 18 décembre YYYY au 18 janvier YYYY+1
 * On a besoin de déterminer quelle année appliquer en fonction du mois
 * On crée un tableau qui renvoie l'année en fonction du mois.
 * Permettra de connaître l'année d'une ligne de transaction SI le relevé (account_statement) est à cheval sur deux années.
 */
$date_arr_year_from_month = array ( 
	$dates_arr_raw[1] => $dates_arr_raw[2],
	$dates_arr_raw[4] => $dates_arr_raw[5]
);

// recherche des lignes de transaction et construction du tableau des lignes de transactions
$regex_transaction='/^[0-9]{2} \.[0-9]{2} [0-9]{2} \.[0-9]{2} [\s\S]*? [0-9]{1,2},\s?[0-9]{0,3}\.?[0-9]*? $/ms';
$matches_line_transaction_raw=preg_match_all( $regex_transaction, $pdf_content, $line_raw );
reset($line_raw);

// boucle sur le tableau. C'est $line_raw[0] qui contient les résultats les plus complets.
echo '<div class="transaction_line">';
echo '<pre>';
echo count($line_raw[0]).'</br>';


for($i = 0; $i < count($line_raw[0]); $i++) {

	// Suppression des retours à la ligne dans les libellés de transaction
	$line_raw[0][$i] = preg_replace('/\n/', ' ', $line_raw[0][$i]);
	echo $line_raw[0][$i].'</br>';

	// On crée des enregistrements correspondant aux transaction

	/* extraire date et ajouter l'année en fonction des dates de début et de fin
	 * ex: 02 .11 02 .11
	 */ 
	$record["transaction"]["date"]["day"] 	= substr($line_raw[0][$i],0,2);
	$record["transaction"]["date"]["month"] = substr($line_raw[0][$i],4,2);
	$record["transaction"]["date"]["year"]	= $date_arr_year_from_month[$record["transaction"]["date"]["month"]];

	$record["transaction"]["date"]["date"]	= new \DateTime();
	$record["transaction"]["date"]["date"]->setDate(
		$record["transaction"]["date"]["year"],
		$record["transaction"]["date"]["month"],
		$record["transaction"]["date"]["day"]
		);
	
	/* Si l'année de début du relevé est
	/ On recherche l'année en

	*/
	//$date_as_transaction -> = new DateTime();

}


echo '</pre>';
echo '</div>';
?>

</body>

</html>
