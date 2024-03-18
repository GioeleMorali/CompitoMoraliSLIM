<?php
class Articolo implements JsonSerializable{
    protected $id;
    protected $nome;
    protected $descrizione;
    protected $prezzo_di_listino;

    public function __construct($id, $nome, $descrizione, $prezzo_di_listino){
        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->prezzo_di_listino = $prezzo_di_listino;
    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getDescrizione(){
        return $this->descrizione;
    }
    public function getPrezzo_di_listino(){
        return $this->prezzo_di_listino;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setDescrizione($descrizione){
        $this->descrizione = $descrizione;
    }
    public function setPrezzo_di_listino($prezzo_di_listino){
        $this->prezzo_di_listino = $prezzo_di_listino;
    }
    public function jsonSerialize() {
        $attrs = [];
        $class_vars = get_class_vars(get_class($this));
        foreach ($class_vars as $name => $value) {
          $attrs[$name]=$this->{$name};
    }
    return $attrs;
}
    public function __toString(){
        return "Articolo: $this->id, Nome: $this->nome, Descrizione: $this->descrizione, Prezzo: $this->prezzo_di_listino";
    }
}