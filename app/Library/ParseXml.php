<?php

namespace App\Library;

class ParseXml {

    private $xml;
    public $usd;
    public $euro;

    public function __construct($xml){
        $this->xml = $xml;
        $this->parse();
    }

    public function parse(){
        $xml = new \SimpleXMLElement($this->xml);
        foreach($xml->Valute as $key => $valute){
            $id = (string)$valute->attributes()->ID;
            switch($id){
                case "R01235":
                    $this->usd = (string)$valute->Value;
                    break;
                case "R01239":
                    $this->euro = (string)$valute->Value;
                    break;
                default:
                    break;
            }

        }
    }

}
