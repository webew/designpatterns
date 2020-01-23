<?php

interface Observateur {
    public function actualiser();
}

interface Sujet {
    public function enregistrerObservateur(Observateur $o);
}

class Donnees implements Sujet {

    private $observateurs;
    private $data;

    public function __construct()
    {
        $this->observateurs = [];
    }

    public function enregistrerObservateur(Observateur $o)
    {
        $this->observateurs[] = $o;
    }

    public function setData(int $data): self {
        $this->data = $data;
        foreach($this->observateurs as $obs){
            $obs->actualiser();
        }
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }
}

class Observer implements Observateur {

    private $donnees;

    public function __construct(Donnees $donnees)
    {
        $this->donnees = $donnees;
        $donnees->enregistrerObservateur($this);
    }

    public function actualiser()
    {
        echo $this->donnees->getData() . "<br>";
    }
}

$donnees = new Donnees();
$obs = new Observer($donnees); // $obs observe $donnees
$donnees->setData(10); // $donnees change => provoque la maj de $obs
$donnees->setData(15);


