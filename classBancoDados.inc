<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of classBancoDados
 *
 * @author VICTOR
 */
class classBancoDados {
    //put your code here
    
    protected $ConexaoBanco;
    protected $IdServidor;
    protected $NumeroUltimoErro;
    protected $DescricaoErro;
    protected $ComandoSQL;
    protected $DataSet;
    protected $NumeroRegistros;    
    
    //Construtor
    
    function __construct($Servidor="") {
        $this->ConexaoBanco=null;
        $this->NumeroUltimoErro=-1;
        $this->DescricaoErro="";
        $this->DataSet=null;
        $this->NumeroRegistros=0;
        
        if($Servidor===""){
            $this->IdServidor="localhost";
        }else{
            $this->IdServidor=$Servidor;
        }
    }
    
    //Métodos públicos
    
    public function AbriConexao() {
        $this->ConexaoBanco = new mysqli($this->IdServidor,"root","1234","db_hotel");
        
        if(mysqli_connect_errno()!=0){
            $this->ConexaoBanco = null;
            $this->NumeroUltimoErro = mysqli_connect_errno();
            $this->DescricaoErro = mysqli_connect_error();
            return false;
        }else{
            $this->ConexaoBanco->set_charset("utf8");
            return $this->ConexaoBanco;
        }
    }
    
    public function CodigoErro() {
        return $this->NumeroUltimoErro;
    }
    
    public function MensagemErro() {
        return $this->DescricaoErro;
    }
    
    public function FecharConexao() {
        if($this->ConexaoBanco === null){
            return false;
        }
        $this->ConexaoBanco->close();
    }
    
    public function SetSELECT($Campos="",$Tabela="") {
        if(($Campos!="")&&($Tabela!="")){
            $this->ComandoSQL = "SELECT " . $Campos . " FROM " . $Tabela;
        }
    }
    
    public function SetWHERE($Clausula="") {
        if($Clausula!=""){
            $this->ComandoSQL .= " WHERE " ;
            $this->ComandoSQL .= $Clausula;
        }
    }
    
    public function SetORDER($CampoOrdenacao="") {
        if($CampoOrdenacao!=""){
            $this->ComandoSQL .= " ORDER BY " ;
            $this->ComandoSQL .= $CampoOrdenacao;
        }
    }

    public function ExecSELECT() {
        if($this->ComandoSQL!=""){
            $this->DataSet = $this->ConexaoBanco->query($this->ComandoSQL);
            if($this->DataSet){
                $this->NumeroRegistros = $this->DataSet->num_rows;
            }
            return true;
        }else{
            return false;
        }
    }
    
    public function TotalRegistros() {
        return $this->NumeroRegistros;
    }
    
    public function GetDataSet() {
        return $this->DataSet;
    }
    
}
