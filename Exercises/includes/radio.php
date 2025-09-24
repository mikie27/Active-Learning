<?php
class Radio {

    public $volume;
    public $frequency;
    public $band;

    function __construct($volume = 5, $frequency = 105.1, $band = "FM"){
        $this->volume = $volume;
        $this->frequency = $frequency;
        $this->band = $band;
    }

    function displayState(){
        echo "Volume: {$this->volume} Frequency: {$this->frequency} Band: {$this->band}";
        echo "<br>";
    }
    function getVolume(){
        return $this->volume;
    }
     function setVolume($volume){
        $this->volume = $volume;
    }
    function getFrequency(){
        return $this->frequency;
    }
     function setFrequency($frequency){
        $this->frequency = $frequency;
    }
    function getBand(){
        return $this->band;
    }
    function setBand($band){
        $this->band = $band;
    }

}

class AudioComponent extends Radio {
    public $compactDisc = false;
    public $track = 0;

    function playingTrack(){
        $this->compactDisc = true;
        echo "Playing track {$this->track} from CD";
        echo "<br>";
    }
    function __construct($volume, $frequency, $band, $track){
    parent::__construct($volume, $frequency, $band);
    $this->track = $track;

}}
$radioObj1 = new Radio();
$radioObj2 = new Radio(9,89.9,"AM");
$audioObj1 = new AudioComponent(7, 101.1, "FM", 3);

$radioObj1->setVolume($radioObj1->getVolume() + 3);
$radioObj2->setFrequency(92.3);

$radioObj1->displayState();
$radioObj2->displayState();
$audioObj1->playingTrack();
?>