<?php

## mowas.php ## 20200307 by do6uk
##
## MoWaS-Gefahrenmeldungen per JSON abrufen und auf DAPNET-Länge kürzen

$MOWAS_URL = 'https://warnung.bund.de/bbk.mowas/gefahrendurchsagen.json';

$mowas_json = file_get_contents($MOWAS_URL);
$mowas_data = json_decode($mowas_json,true);

## debug: Ausgabe der Meldungsstruktur
echo "<code>## WoWaS-Meldungen ## Land-Kreis Warnung/Entwarnung: Meldung ##</code><br><br>";

foreach ($mowas_data as $message) {
	## Regionale Zuordnung aus Sender
	$sender = explode('-',$message['sender'],4);
	$land = $sender[0];
	$bund = $sender[1];
	$kreis = $sender[2];
	$kenn = $sender[3];

	## Headline
	$headline = $message['info'][0]['headline'];

	## Entwarnung erkennen
	if (strpos(strtolower($headline),'entwarnung') !== false) {
		$warn = "E";
		# Wort aus Meldung löschen (und damit Zeichen gewinnen)
		if (substr(strtolower($headline),'entwarnung: ') == 0) {
			$headline = str_ireplace('entwarnung: ','',$headline);
		}
	} else {
		# Warnung
		$warn = "W";
	}


	## Land-Kreis W(arnung)/E(ntwarnung): Meldung
	$msg = $bund.'-'.$kreis.' '.$warn.':'.$headline;

	## Umlaute ersetzen
	$msg = str_replace('ä','ae',$msg);
	$msg = str_replace('ö','oe',$msg);
	$msg = str_replace('ü','ue',$msg);
	$msg = str_replace('Ä','Ae',$msg);
	$msg = str_replace('Ö','Oe',$msg);
	$msg = str_replace('Ü','Ue',$msg);
	$msg = str_replace('ß','ss',$msg);

	## Meldung kürzen + '..' oder ' #' bei vollständiger Meldung
	if (strlen($msg) > 78) {
		$msg = substr($msg,0,78).'..';
	} else {
		$msg = $msg.' #';
	}

	## debug: Länge hinter Meldung ausgeben
	$msg .= ' ('.strlen($msg).')';

	## Meldung ausgeben
	echo "<code>$msg</code><br>";

}

?>
