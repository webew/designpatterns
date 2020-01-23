<?php
// une interface avec 2 méthodes
interface MonInterface {
    public function direBonjour();
    public function direAuRevoir();
} 

// une classe que l'on ne souhaite pas modifier 
// mais dont on souhaite utiliser les méthodes
class ClasseDeBase {
    public function sayHi(){
        echo 'Hi !';
    }
    public function saySeeYa(){
        echo "See Ya !";
    }
}

// une classe qui fournit l'accès aux méthodes de la classe de base
class Adapter implements MonInterface {
    private $classeDeBase;

    public function __construct(ClasseDeBase $classeDeBase)
    {
        $this->classeDeBase = $classeDeBase;
    }
    public function direBonjour(){
        return $this->classeDeBase->sayHi();
    }
    public function direAuRevoir(){
        return $this->classeDeBase->saySeeYa();
    }
}

// la classe qui souhaite utiliser 
// les méthodes de la classe de base
class Adaptee {
    public function sayHello(MonInterface $adapter){
        return $adapter->direBonjour();
    }
    public function sayBye(MonInterface $adapter){
        return $adapter->direAuRevoir();
    }
}

$classeDeBase = new ClasseDeBase();
$adapter = new Adapter($classeDeBase);// l'adapter englobe la classeDeBase pour pouvoir utiliser ses méthodes

$adaptee = new Adaptee(); // l'objet qui doit utiliser l'adapter
$adaptee->sayHello($adapter); // $adapter va appeler sayHi de la classe de base (via sa méthode direBonjour )
$adaptee->sayBye($adapter); // $adapter va appeler saySeeYa de la classe de base (via sa méthode direAuRevoir )