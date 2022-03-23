<?php

//namespace 	htjan\yaosap;

/* Include Composer autoloader if not already done.
 * Needs a symbolic link to composer in YAOSSA root/html directory to composer root directory
 */
use         htjan\yaosaa\cls\ctl\Initializer;
use 		htjan\yaosap\cls\ctl\MonthCalendar as cls_mc ;
use 		htjan\yaosap\cls\mdl\AppConfig as AppConfig;

require_once ( $_SERVER['CONTEXT_DOCUMENT_ROOT'].'cls/ctl/Initializer.php' );
$initializer    = new Initializer();
$app_config     = $initializer->getParameters();
// Launch Appconfig to get application variables
// $app_config = new AppConfig();

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

<p>Test de texte</p>

<?php


	// Parse pdf file and build necessary objects.
    //file_get_contents ( string $filename [, bool $use_include_path = false [, resource $context [, int $offset = 0 [, int $maxlen ]]]] )
    $as_text_pdf = file_get_contents($app_config["YAOSAP_IMPORT_IN_DIR"]."RLV_CHQ_300040170400000113109_20180820.pdf");
    $as_text_pdf = preg_replace('/\t/', ' ', $as_text_pdf);
    
    //$as_parser = new \Smalot\PdfParser\Parser();
    //$as_doc_pdf = $as_parser->parseFile(AppConfig::YAOSAP_IMPORT_IN_DIR.'RLV_CHQ_300040170400000113109_20180820.pdf');
	//$as_text_pdf = $as_doc_pdf->getText();
	// transformation des tabulations par des espaces/
	//$as_text_pdf = preg_replace('/\t/', ' ', $as_text_pdf);

//DEBUG : impression du texte contenu dans le pdf
// echo '<div class="text_lines">';
// echo '<pre>';
// echo $as_text_pdf;
// echo '</pre>';
// echo '</div>';

// PARSING

// Recherche de la date RIB, de l'IBAN et du BIC
// $as_rib_regex 		= '/RIB :[\s\S]*[0-9]{5} [0-9]{5} [0-9]{11} [0-9]{2}/';
$as_rib_regex 		= '/^RIB[\s\S]*:[\s\S]*[0-9]{5} [0-9]{5} [0-9]{11} [0-9]{2}$/m';
$as_iban_regex		= '/^IBAN[\s\S]*:[\s\S]*[a-zA-Z]{2}[0-9]{2} [0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4} [0-9]{3}$/m';
$as_bic_regex 		= '/^BIC[\s\S]*:[\s\S]*[a-zA-Z]{11}$/m';
$as_account[]       = array();

//RIB
$as_rib_res         = array();
$as_rib_count 		= preg_match ( $as_rib_regex , $as_text_pdf , $as_rib_res);
$as_account["rib"]	= trim (substr ( $as_rib_res[0] , 5 ) );

//IBAN
$as_iban_count 		= preg_match ( $as_iban_regex , $as_text_pdf , $as_iban_res);
$as_account["iban"] = trim (substr ( $as_iban_res[0] , 0 ) );

//BIC
$as_bic_count 		= preg_match ( $as_bic_regex , $as_text_pdf , $as_bic_res);
$as_account["bic"]	= trim (substr ( $as_bic_res[0] , 5 ) );


/* Recherche des date du relevé : pdf -> nomde variable : Account statement accnt_stmt & as
 *  On ne prend que le premier, celui de la première page : preg_match au lieu de preg_match_all. Les autres sont identiques
 *  du 31 octobre 2012 au 18 novembre 2012
 */
$mo_cal			= new cls_mc;
$month_calendar = $mo_cal->getLabelList();
unset($mo_cal);

//^[\s\S]*du[\s\S]*[0-3][0-9][\s\S]*(janvier|février|mars|avril|mai|juin|juillet|août|septembre|octobre|novembre|décembre)[\s\S]*2[0-9]{3}[\s\S]*au[\s\S]*[0-3][0-9][\s\S]*(janvier|février|mars|avril|mai|juin|juillet|août|septembre|octobre|novembre|décembre)[\s\S]*2[0-9]{3}[\s\S]*$


$as_dates_regex = '/^[\s\S]*du[\s\S]*[0-3][0-9][\s\S]*('.implode("|",$month_calendar).')[\s\S]*2[0-9]{3}[\s\S]*au[\s\S]*[0-3][0-9][\s\S]*('.implode("|",$month_calendar).')[\s\S]*2[0-9]{3}[\s\S]*$/mi';
$count = preg_match ( $as_dates_regex , $as_text_pdf , $as_dates_arr_raw);

echo ("<pre>");
print_r($as_dates_arr_raw);
echo ("</pre>");


// la chaine de date est contenue dans $dates_raw[0]. On remplace la valeur de la variable par un tableau à deux valeur : Date de début et date de fin.
// Suppression de "du" et du "au"
$as_dates_arr_raw[0] = str_replace ( "du ", "", $as_dates_arr_raw[0] );
$as_dates_arr_raw[0] = str_replace (" au ", " ", $as_dates_arr_raw[0] );

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
$as_dates_arr_raw = explode(" ", $as_dates_arr_raw[0]);

// remplacement du libellé du mois par le nombre correspondant.
$cls_mc			= new cls_mc;
$month_calendar = $cls_mc->getLabelList();
$as_dates_arr_raw[1]	= 	$cls_mc->getNumFromLabel($as_dates_arr_raw[1]);
$as_dates_arr_raw[4]	=	$cls_mc->getNumFromLabel($as_dates_arr_raw[4]);
unset($mo_cal);
//~ foreach ($month_calendar as $k => $val) {

	//~ if ( $val == $as_dates_arr_raw[1] ) {
		//~ $as_dates_arr_raw[1] = $k;
	//~ }
	//~ if ( $val == $as_dates_arr_raw[4] ) {
		//~ $as_dates_arr_raw[4] = $k;
	//~ }
//~ }

// Construction des dates du relevé
$as_date = array();
$as_date["first"] 	= 	new \DateTime();
$as_date["first"] 	-> 	setDate( $as_dates_arr_raw[2], $as_dates_arr_raw[1], $as_dates_arr_raw[0] );
$as_date["last"] 	= 	new \DateTime();
$as_date["last"] 	-> 	setDate( $as_dates_arr_raw[5], $as_dates_arr_raw[4], $as_dates_arr_raw[3] );



/* Dans tous les relevés, l'année de début du relevé est identique à l'année de fin, SAUF pour le relevé du mois de décembre.
 * Ce fichiers est sur deux années 18 décembre YYYY au 18 janvier YYYY+1
 * On a besoin de déterminer quelle année appliquer en fonction du mois
 * On crée un tableau qui renvoie l'année en fonction du mois.
 * Permettra de connaître l'année d'une ligne de transaction SI le relevé (account_statement) est à cheval sur deux années.
 */
$as_date_arr_year_from_month = array ( 
	$as_dates_arr_raw[1] => $as_dates_arr_raw[2],
	$as_dates_arr_raw[4] => $as_dates_arr_raw[5]
);

// recherche des lignes de transaction et construction du tableau des lignes de transactions
$regex_transaction='/^[0-9]{2} \.[0-9]{2} [0-9]{2} \.[0-9]{2} [\s\S]*? [0-9]{1,2},\s?[0-9]{0,3}\.?[0-9]*? $/ms';
$matches_line_transaction_raw=preg_match_all( $regex_transaction, $as_text_pdf, $line_raw );
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
	$record["transaction"]["date"]["year"]	= $as_date_arr_year_from_month[$record["transaction"]["date"]["month"]];

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
