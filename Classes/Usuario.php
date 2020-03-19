<?php
require_once ("RIOT_API.php");
class Usuario extends RIOT_API
{
    private $ID;
    private $Nome;
    private $PUUID;
    private $IDicone;
    private $IDconta;
    private $Level;
    private $eloflex;
    private $rankflex;
    private $elosolo;
    private $ranksolo;
    private $jogadassolo;
    private $winratesolo;
    private $winrateflex;
    private $jogadasflex;
    function __construct($nome)
    {
        require_once("config/key.php");
        $this->setKey(key_api);
        $ch = curl_init();
        $this->Nome =  $nome;
        $result = $this->request('lol/summoner/v4/summoners/by-name/' . curl_escape($ch ,$this->Nome));
        if(!is_int($result)) {
            $this->PUUID = $result->puuid;
            $this->IDconta = $result->accountId;
            $this->ID = $result->id;
            $this->Level = $result->summonerLevel;
            $this->IDicone = $result->profileIconId;
        }else{
            header('location: index.php?ID=1');
        }
        $this->getELo();
    }

    private function getELo()
    {
        $result = $this->request("/lol/league/v4/entries/by-summoner/".$this->ID);
        if(@$result['0']->queueType=="RANKED_FLEX_SR" && @$result['1']->queueType===null){
            $this->eloflex = $result['0']->tier;
            $this->rankflex =$result['0']->rank;
            $losses = $result['0']->losses;
            $wins = $result['0']->wins;
            $jogadas = $losses + $wins;
            $this->winrateflex = round(($wins*100)/$jogadas,1);
            $this->jogadasflex = $jogadas;
        }elseif(@$result['0']->queueType=="RANKED_SOLO_5x5" && @$result['1']->queueType===null){
            $this->elosolo = $result['0']->tier;
            $this->ranksolo =$result['0']->rank;
            $losses = $result['0']->losses;
            $wins = $result['0']->wins;
            $jogadas = $losses + $wins;
            $this->winratesolo = round(($wins*100)/$jogadas,1);
            $this->jogadassolo = $jogadas;
        }elseif (@$result['0']->queueType=="RANKED_FLEX_SR" && @$result['1']->queueType=="RANKED_SOLO_5x5"){
            $this->elosolo = $result['1']->tier;
            $this->ranksolo =$result['1']->rank;
            $this->rankflex =$result['0']->rank;
            $this->eloflex =$result['0']->tier;

            $losses1 = $result['1']->losses;
            $wins1 = $result['1']->wins;
            $jogadas1 = $losses1 + $wins1;
            $this->winratesolo = round(($wins1*100)/$jogadas1,1);
            $this->jogadassolo = $jogadas1;
            $losses2 = $result['0']->losses;
            $wins2 = $result['0']->wins;
            $jogadas2 = $losses2 + $wins2;
            $this->winrateflex = round(($wins2*100)/$jogadas2,1);
            $this->jogadasflex = $jogadas2;
        }elseif (@$result['0']->queueType=="RANKED_SOLO_5x5" && @$result['1']->queueType=="RANKED_FLEX_SR"){
            $this->elosolo = $result['0']->tier;
            $this->ranksolo =$result['0']->rank;
            $this->rankflex =$result['1']->rank;
            $this->eloflex =$result['1']->tier;

            $losses1 = $result['0']->losses;
            $wins1 = $result['0']->wins;
            $jogadas1 = $losses1 + $wins1;
            $this->winratesolo = round(($wins1*100)/$jogadas1,1);
            $this->jogadassolo = $jogadas1;
            $losses2 = $result['1']->losses;
            $wins2 = $result['1']->wins;
            $jogadas2 = $losses2 + $wins2;
            $this->winrateflex = round(($wins2*100)/$jogadas2,1);
            $this->jogadasflex = $jogadas2;
        }
    }
    function getITEMS($request){
        switch ($request){
            case 1:
                return $this->ID;
                break;
            case 2:
                return $this->Nome;
                break;
            case 3:
                return $this->PUUID;
                break;
            case 4:
                return $this->IDicone;
                break;
            case 5:
                return $this->IDconta;
                break;
            case 6:
                return $this->Level;
                break;
            case 7:
                return $this->eloflex;
                break;
            case 8:
                return $this->rankflex;
                break;
            case 9:
                return $this->elosolo;
                break;
            case 10:
                return $this->ranksolo;
                break;
            case 12:
                return $this->winrateflex;
                break;
            case 13:
                return $this->jogadasflex;
                break;
            case 14:
                return $this->winratesolo;
                break;
            case 15:
                return $this->jogadassolo;
                break;
        }
    }
}