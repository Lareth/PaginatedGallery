<?php
/*
Pagination Klasse
Author: Lars Kuske

*/


@include_once('/../../common.php'); 		//Common PHP Includen

class Pagination {

	private $getParams;
	private $code;
	
	private $aktuelleSeite;
	private $gesamteSeitenZahl;
	private $dargestellteSeiten = 10;

	//Konstruktor
	public function __construct ($getParams, $seite, $gesamteSeitenZahl) {
		$this->getParams = $getParams;
		$this->setAktuelleSeite($seite);
		$this->setGesamteSeitenZahl($gesamteSeitenZahl);
	}
	
	public function setAktuelleSeite($seite){
		$this->aktuelleSeite = $seite;
	}
	
	public function setGesamteSeitenZahl($number){
		$this->gesamteSeitenZahl = $number;
	}
	
	public function getPagination(){
		$this->bauePagination();
		return $this->code;
	}
	
	private function bauePagination(){												//Funktion zum Bauen der Pagination
		$get = $this->getParams;
		$code ="";

		$aktuelleSeite = (int)$this->aktuelleSeite;

		if($aktuelleSeite > $this->gesamteSeitenZahl){
			$this->aktuelleSeite = 1;
			$aktuelleSeite = 1;
		}

		if($this->gesamteSeitenZahl > 1){
			$zwischenlinks = $this->dargestellteSeiten - 2;	
			if($this->gesamteSeitenZahl < $this->dargestellteSeiten ){		//Wenn es gar nicht so viele Seiten gibt, müssen weniger Seiten generiert werden
				$zwischenlinks = $this->gesamteSeitenZahl - 2;
				if ($zwischenlinks < 0){
					$zwischenlinks = 0;
				}
			}

			$umgebendeSeiten = (int)$zwischenlinks / 2;

			if(($aktuelleSeite - $umgebendeSeiten) < 2){
				$startpunkt = 2;	//Anfangs ist der Startpunkt 2
			}else{
				if(($aktuelleSeite + $umgebendeSeiten) < $this->gesamteSeitenZahl - 1){
					$startpunkt = $aktuelleSeite - $umgebendeSeiten;
				}else{
					$startpunkt = $this->gesamteSeitenZahl - $zwischenlinks;
				}
			}

			$code .= "<ul class=\"pagination\">";
			//Ersten Link erzeugen:
			$firstlinktext = "";
			if($aktuelleSeite == 1 || $startpunkt == 2){
				$firstlinktext = "1";
			}else{
				$firstlinktext = "&laquo;";
			}
			$get["seite"] = 1;
			$adresse = http_build_query($get);

			if($aktuelleSeite == 1){
				$code.= "\t<li class=\"pagination-item pagination-current\"><a href=\"?" . $adresse . "\">$firstlinktext</a></li>\n";
			}else{
				$code.= "\t<li class=\"pagination-item\"><a href=\"?" . $adresse . "\">$firstlinktext</a></li>\n";
			}

			//Die nächsten x Links erzeugen

			$aktuellerPunkt = $startpunkt;

			for ($i = 1;$i <= $zwischenlinks;$i++){
				$get["seite"] = (int)$aktuellerPunkt;
				$adresse = http_build_query($get);
				$ausgegebeneSeite = (int)$aktuellerPunkt;
				if((int)$aktuellerPunkt == $aktuelleSeite){
					$code.= "\t<li class=\"pagination-item pagination-current\"><a href=\"?" . $adresse . "\">$ausgegebeneSeite</a></li>\n";
				}else{
					$code.= "\t<li class=\"pagination-item\"><a href=\"?" . $adresse . "\">$ausgegebeneSeite</a></li>\n";
				}
				$aktuellerPunkt++;
			}

			//letzten Link erzeugen

			$lastlinktext = "";
			if($aktuelleSeite == $this->gesamteSeitenZahl || $startpunkt == ($this->gesamteSeitenZahl - $zwischenlinks)){
				$lastlinktext = $this->gesamteSeitenZahl;
			}else{
				$lastlinktext = "&raquo;";
			}

			$get["seite"] = $this->gesamteSeitenZahl;
			$adresse = http_build_query($get);

			if($aktuelleSeite == $this->gesamteSeitenZahl){
				$code.= "\t<li class=\"pagination-item pagination-current\"><a href=\"?" . $adresse . "\">$lastlinktext</a></li>\n";
			}else{
				$code.= "\t<li class=\"pagination-item\"><a href=\"?" . $adresse . "\">$lastlinktext</a></li>\n";
			}
			$code .= "</ul>";
		}
		$this->code = $code;
	}
}// end class

?>