<?php
class OrdineOnline extends Ordine{
    protected $indirizzo_ip;
    protected $codice_di_autorizzazione;

    public function __construct($numero_ordine, $data, $importo_totale, $indirizzo_ip, $codice_di_autorizzazione){
        parent::__construct($numero_ordine, $data, $importo_totale);
        $this->indirizzo_ip = $indirizzo_ip;
        $this->codice_di_autorizzazione = $codice_di_autorizzazione;
    }
    public function getIndirizzo_ip(){
        return $this->indirizzo_ip;
    }
    public function getCodice_di_autorizzazione(){
        return $this->codice_di_autorizzazione;
    }
    public function setIndirizzo_ip($indirizzo_ip){
        $this->indirizzo_ip = $indirizzo_ip;
    }
    public function setCodice_di_autorizzazione($codice_di_autorizzazione){
        $this->codice_di_autorizzazione = $codice_di_autorizzazione;
    }
    public function __toString(){
        return "Numero ordine: $this->numero_ordine, Data: $this->data, Importo totale: $this->importo_totale, Articoli venduti: $this->articoli_venduti, Indirizzo IP: $this->indirizzo_ip, Codice di autorizzazione: $this->codice_di_autorizzazione";
    }
}