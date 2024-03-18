<?php
require ("Ordine.php");
class Negozio implements JsonSerializable{
    protected $nome;
    protected $telefono;
    protected $indirizzo;
    protected $sito;
    protected $p_iva;
    protected $ordini;
    protected $articoli = [];

    public function __construct(){
        $this->nome = "Negozione";
        $this->telefono = "3333333333";
        $this->indirizzo = "Via Roma 1";
        $this->sito = "www.negozio.it";
        $this->p_iva = "12345678901";
        $this->ordini = [];
        $av1 = new Articolo_venduto(1, "Penne", "Penne nere", 1.50, 10, 1);
        $av2 = new Articolo_venduto(2, "Penne", "Penne rosse", 1.50, 10, 1);
        $av3 = new Articolo_venduto(3, "Penne", "Penne blu", 1.50, 10, 1);
        $av4 = new Articolo_venduto(4, "Penne", "Penne verdi", 1.50, 10, 1);
        $av5 = new Articolo_venduto(5, "Penne", "Penne viola", 1.50, 10, 1);

        $art1 = new Articolo(1, "Zaino", "Zaino blu", 1.50);
        $art2 = new Articolo(2, "Zaino", "Zaino rosso", 1.50);
        $art3 = new Articolo(3, "Zaino", "Zaino verde", 1.50);
        $art4 = new Articolo(4, "Zaino", "Zaino giallo", 1.50);
        array_push($this->articoli, $art1);
        array_push($this->articoli, $art2);
        array_push($this->articoli, $art3);
        array_push($this->articoli, $art4);

        $of1 = new OrdineFisico(1, "2021-01-01", 2, "Contanti");
        $of1->addArticoli_venduti($av1);
        $of1->addArticoli_venduti($av5);
        $of2 = new OrdineFisico(2, "2021-01-02", 100, "Carta");
        $of2->addArticoli_venduti($av2);
        $of3 = new OrdineOnline(3, "2021-01-03", 100, "172.0.0.1", "123456");
        $of3->addArticoli_venduti($av3);
        $of4 = new OrdineOnline(4, "2021-01-04", 100, "173.13.0.2", "123457");
        $of4->addArticoli_venduti($av4);
        
        $this->addOrdini($of1);
        $this->addOrdini($of2);
        $this->addOrdini($of3);
        $this->addOrdini($of4);
    }

    public function getNome(){
        return $this->nome;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getIndirizzo(){
        return $this->indirizzo;
    }
    public function getSito(){
        return $this->sito;
    }
    public function getPiva(){
        return $this->p_iva;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function setIndirizzo($indirizzo){
        $this->indirizzo = $indirizzo;
    }
    public function setSito($sito){
        $this->sito = $sito;
    }
    public function setPiva($p_iva){
        $this->p_iva = $p_iva;
    }
    public function addOrdini($ordine)
    {
        array_push($this->ordini, $ordine);
    }
    public function getArticoli()
    {
        return $this->articoli;
    }
    public function getIdArticoli($id)
    {
        foreach ($this->articoli as $articolo) {
            if ($articolo->getId() == $id['id']) {
                return $articolo;
            }
        }
        return null;
    }
    public function getArticoliVenduti($id)
    {
        foreach ($this->ordini as $ordine) {
            if ($ordine->getNumero_ordine() == $id['numero_ordine'])  {
                return $ordine->getArticoli_venduti();
            }
        }
        return [];
    }
    public function getArticoliVendutiOrdine($id)
    {
        foreach ($this->ordini as $ordine) {
            if ($ordine->getNumero_ordine() == $id['numero_ordine'])  {
                foreach ($ordine->getArticoli_venduti() as $articolo) {
                    if ($articolo->getId() == $id['id']) {
                        return $articolo;
                    }
                }
            }
        }
        return null;
    }
    public function getSommaDeiPrezziDiVendita($id)
    {
        foreach ($this->ordini as $ordine) {
            if ($ordine->getNumero_ordine() == $id['numero_ordine'])  {
                foreach ($ordine->getArticoli_venduti() as $articolo) {
                     $somma = $somma + $articolo->getPrezzo_di_vendita();
                }
            }
        }
        return $somma;
    }
    public function getVerificaImportoOrdine($id)
    {
        foreach ($this->ordini as $ordine) {
            if ($ordine->getNumero_ordine() == $id['numero_ordine'])  {
                if($ordine->getImporto_totale() == $this->getSommaDeiPrezziDiVendita($id)){
                    return true;
                }
            }
        }
        return false;
    }
    public function getOrdini()
    {
        return $this->ordini;
    }
    public function getIdOrdini($id)
    {
        foreach ($this->ordini as $ordine) {
            if ($ordine->getNumero_ordine() == $id['numero_ordine']) {
                return $ordine;
            }
        }
        return null;
    }
    public function getSommaListino($id)
    {
        foreach ($this->ordini as $ordine) {
            if ($ordine->getNumero_ordine() == $id['numero_ordine'])  {
                foreach ($ordine->getArticoli_venduti() as $articolo) {
                     $somma = $somma + $articolo->getPrezzo_di_listino();
                }
            }
        }
        return $somma;  
    }
    public function getSconto($id)
    {
        foreach ($this->ordini as $ordine) {
            if ($ordine->getNumero_ordine() == $id['numero_ordine'])  {
                if($this->getSommaListino($id) - $this->getSommaDeiPrezziDiVendita($id) == 0){
                    return 0;
                }
                else if($this->getSommaListino($id) - $this->getSommaDeiPrezziDiVendita > 0)
                {
                    return $this->getSommaListino($id) - $this->getSommaDeiPrezziDiVendita($id);
                
                }
            }
        }
        return -1;
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
        return "Negozio: $this->nome, Telefono: $this->telefono, Indirizzo: $this->indirizzo, Sito: $this->sito, P.Iva: $this->p_iva";
    }
}