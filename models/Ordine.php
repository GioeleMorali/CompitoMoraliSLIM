<?php
class Ordine implements JsonSerializable{
    protected $numero_ordine;
    protected $data;
    protected $importo_totale;
    protected $articoli_venduti;

    public function __construct($numero_ordine, $data, $importo_totale){
        $this->numero_ordine = $numero_ordine;
        $this->data = $data;
        $this->importo_totale = $importo_totale;
        $this->articoli_venduti = []; 
    }

    public function getNumero_ordine(){
        return $this->numero_ordine;
    }
    public function getData(){
        return $this->data;
    }
    public function getImporto_totale(){
        return $this->importo_totale;
    }
    public function getArticoli_venduti(){
        return $this->articoli_venduti;
    }
    public function setNumero_ordine($numero_ordine){
        $this->numero_ordine = $numero_ordine;
    }
    public function setData($data){
        $this->data = $data;
    }
    public function setImporto_totale($importo_totale){
        $this->importo_totale = $importo_totale;
    }
    public function setArticoli_venduti($articoli_venduti){
        $this->articoli_venduti = $articoli_venduti;
    }
    public function addArticoli_venduti($articolo_venduto)
    {
        array_push($this->articoli_venduti, $articolo_venduto);
    }
    public function __toString(){
        return "Numero ordine: $this->numero_ordine, Data: $this->data, Importo totale: $this->importo_totale, Articoli venduti: $this->articoli_venduti";
    }
    public function jsonSerialize() {
        $attrs = [];
        $class_vars = get_class_vars(get_class($this));
        foreach ($class_vars as $name => $value) {
          $attrs[$name]=$this->{$name};
    }
    return $attrs;
}

}