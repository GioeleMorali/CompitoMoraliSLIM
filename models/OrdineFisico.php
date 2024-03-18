<?php
class OrdineFisico extends Ordine{
    protected $pagamento;

    public function __construct($numero_ordine, $data, $importo_totale, $pagamento){
        parent::__construct($numero_ordine, $data, $importo_totale);
        $this->pagamento = $pagamento;
    }
    public function getPagamento(){
        return $this->pagamento;
    }
    public function setPagamento($pagamento){
        $this->pagamento = $pagamento;
    }
    public function __toString(){
        return "Numero ordine: $this->numero_ordine, Data: $this->data, Importo totale: $this->importo_totale, Articoli venduti: $this->articoli_venduti, Pagamento: $this->pagamento";
    }
}