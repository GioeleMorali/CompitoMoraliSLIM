<?php
class Articolo_venduto extends Articolo{
    protected $id;
    protected $quantita_acquistata;
    protected $prezzo_di_vendita;

    public function __construct($id, $nome, $descrizione, $prezzo_di_listino, $quantita_acquistata, $prezzo_di_vendita){
        parent::__construct($id, $nome, $descrizione, $prezzo_di_listino);
        $this->quantita_acquistata = $quantita_acquistata;
        $this->prezzo_di_vendita = $prezzo_di_vendita;
    }

    public function getQuantita_acquistata(){
        return $this->quantita_acquistata;
    }
    public function getPrezzo_di_vendita(){
        return $this->prezzo_di_vendita;
    }
    public function setQuantita_acquistata($quantita_acquistata){
        $this->quantita_acquistata = $quantita_acquistata;
    }
    public function setPrezzo_di_vendita($prezzo_di_vendita){
        $this->prezzo_di_vendita = $prezzo_di_vendita;
    } 
    public function __toString(){
        return "Articolo: $this->id, Nome: $this->nome, Descrizione: $this->descrizione, Prezzo: $this->prezzo_di_listino, Quantita: $this->quantita_acquistata, Prezzo di vendita: $this->prezzo_di_vendita";
    }

}