<?php 
// transformation des dates du relevé en timestamp
$date_fmt_as = new IntlDateFormatter("fr-FR", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Etc/UTC', IntlDateFormatter::GREGORIAN, 'dd MMMM y');
$date_ts_accnt_stmt_first = $date_fmt_as ->parse($dates_raw_arr_as[0]);
$date_ts_accnt_stmt_last = $date_fmt_as ->parse($dates_raw_arr_as[1]);

$date_temp_var = new DateTime();

// création de tableau contenant en clé le mois numérique et en valeur l'année. Sera utilisé pour ajouter 
$date_interval["first"]["month"] = ($date_temp_var->setTimestamp($date_ts_first))->format('m');
$date_interval["first"]["year"] = ($date_temp_var->setTimestamp($date_ts_first))->format('Y');
$date_interval["last"]["month"] = ($date_temp_var->setTimestamp($date_ts_last))->format('m');
$date_interval["last"]["year"] = ($date_temp_var->setTimestamp($date_ts_last))->format('Y');
?>
