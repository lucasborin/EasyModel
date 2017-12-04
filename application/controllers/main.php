<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
    function __construct() {
        parent::__construct();
 
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('cezpdf');
		$this->load->library('grocery_CRUD');
			
		$this->theme->set_theme('default'); 	
	}
 
    public function index() {		
        $this->output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));  
    }
		
    function output($output = NULL) {
		$this->theme->view('main');	
		
        $this->load->view('main.php',$output);
    }
	
    public function categoria() {
        $this->grocery_crud->set_table('categoria');
		$this->grocery_crud->required_fields('nome');
        $this->grocery_crud->set_subject('Categoria');
 
		$output = $this->grocery_crud->render();
        $this->output($output);             
    }
    
	public function areaProcesso() {
        $this->grocery_crud->set_table('areaprocesso');
		
		$this->grocery_crud->required_fields('sigla', 'nome', 'descricao', 'idCategoria', 'idNivelMaturidade', 'idModelo');
		
        $this->grocery_crud->set_subject('Area de Processo');
		
		$this->grocery_crud->set_relation('idCategoria','categoria','nome');
		$this->grocery_crud->set_relation('idNivelMaturidade','nivelMaturidade','nome');
		$this->grocery_crud->set_relation('idModelo','modelo','nome');
		
		$this->grocery_crud->display_as('idCategoria','Categoria');
		$this->grocery_crud->display_as('idNivelMaturidade','Nivel de Maturidade');
		$this->grocery_crud->display_as('idModelo','Modelo');
		$this->grocery_crud->display_as('descricao','Descrição');
 
		$output = $this->grocery_crud->render();
        $this->output($output);             
    }
		
	public function metaEspecifica() {
        $this->grocery_crud->set_table('metaespecifica');
		
		$this->grocery_crud->required_fields('sigla', 'nome', 'descricao', 'idAreaProcesso');
		
        $this->grocery_crud->set_subject('Meta Específica');
		
		$this->grocery_crud->set_relation('idAreaProcesso','areaProcesso','nome');
		
		$this->grocery_crud->display_as('idAreaProcesso','Area de Processo');
		$this->grocery_crud->display_as('descricao','Descrição');
 
		$output = $this->grocery_crud->render();
        $this->output($output);    	
    } 
	
	public function metaGenerica() {
        $this->grocery_crud->set_table('metagenerica');
		
		$this->grocery_crud->required_fields('sigla', 'nome', 'descricao', 'sigla', 'idModelo', 'idNivelCapacidade');
		
        $this->grocery_crud->set_subject('Meta Genérica');
		
		$this->grocery_crud->set_relation('idModelo','modelo','nome');
		$this->grocery_crud->set_relation('idNivelCapacidade','nivelCapacidade','nome');
		
		$this->grocery_crud->display_as('idNivelCapacidade','Nivel de Capacidade');
		$this->grocery_crud->display_as('idModelo','Modelo');
		$this->grocery_crud->display_as('descricao','Descrição');
 
		$output = $this->grocery_crud->render();
        $this->output($output);              
    } 

	public function modelo() {
        $this->grocery_crud->set_table('modelo');
		
		$this->grocery_crud->required_fields('sigla', 'nome', 'descricao');
		
        $this->grocery_crud->set_subject('Modelo');
		
		$this->grocery_crud->display_as('descricao','Descrição');
 
		$output = $this->grocery_crud->render();
        $this->output($output);               
    } 
	
	public function nivelCapacidade() {
        $this->grocery_crud->set_table('nivelcapacidade');
		
		$this->grocery_crud->required_fields('sigla', 'nome', 'descricao');
		
        $this->grocery_crud->set_subject('Nivel de Capacidade');
		
		$this->grocery_crud->display_as('descricao','Descrição');
 
		$output = $this->grocery_crud->render();
        $this->output($output);              
    } 
	
	public function nivelMaturidade() {
        $this->grocery_crud->set_table('nivelmaturidade');
		
		$this->grocery_crud->required_fields('sigla', 'nome', 'descricao');
		
        $this->grocery_crud->set_subject('Nivel de Maturidade');
		
		$this->grocery_crud->display_as('descricao','Descrição');
 
		$output = $this->grocery_crud->render();
        $this->output($output);        
    } 
	
	public function praticaEspecifica() {
        $this->grocery_crud->set_table('praticaespecifica');

        $this->grocery_crud->set_subject('Pratica Específica');
		
		$this->grocery_crud->set_relation('idMetaEspecifica','metaespecifica','nome');	
		
		$this->grocery_crud->set_relation_n_n('produtotrabalhopraticaespecifica', 'produtotrabalhopraticaespecifica', 'produtotrabalho', 'idPraticaEspecifica', 'idProdutoTrabalho', 'nome');
				
		$this->grocery_crud->display_as('idMetaEspecifica','Meta Específica');
		$this->grocery_crud->display_as('descricao','Descrição');
		$this->grocery_crud->display_as('produtotrabalhopraticaespecifica','Produto de Trabalho');
	
		$this->grocery_crud->required_fields('sigla', 'nome', 'descricao', 'idMetaEspecifica');
		
		$output = $this->grocery_crud->render();
        $this->output($output);    
    } 
	
	public function produtoTrabalho() {
        $this->grocery_crud->set_table('produtotrabalho');
		
		$this->grocery_crud->required_fields('sigla', 'nome', 'template');
		
        $this->grocery_crud->set_subject('Produto de Trabalho');
  
		$this->grocery_crud->set_field_upload('template','assets/uploads/files');
  
		$output = $this->grocery_crud->render();
        $this->output($output);              
    } 
	
	public function generateReport() {	
	    
		$modelos = $this->db->get('modelo');
		
		// Titulo 	
		$this->cezpdf->ezText('Grau B', 14, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
			
		// Integrantes
		$this->cezpdf->ezText("<b>Integrantes:</b>", 12);		
		$this->cezpdf->ezText("Lucas Borin", 10);
		
		// Modelo
		foreach ($modelos->result() as $modelo) {	
		 	$this->cezpdf->ezNewPage();
			$this->cezpdf->ezText("<b>".$modelo->nome."</b>", 12);
			$this->cezpdf->ezSetDy(-10);
			
			// Metas Genericas
			$this->db->select('mg.sigla, mg.nome, mg.descricao, nc.nome as capacidade');
			$this->db->from('metagenerica mg');
			$this->db->join('nivelcapacidade nc', 'mg.idNivelCapacidade', "nc.idNivelCapacidade");
			$this->db->where('mg.idModelo', $modelo->idModelo);
			$metasgenericas = $this->db->get();
			$table = array( );
			
			foreach ($metasgenericas->result() as $metagenerica) {
				$table[] = array(
				  "Sigla"=>$metagenerica->sigla,
				  "Nome"=>$metagenerica->nome,
				  "Descrição"=>$metagenerica->descricao,
				  "Nível de Capacidade"=>$metagenerica->capacidade
				);
			};
			
			$this->cezpdf->ezTable($table, "", "Metas Genéricas");
			 
			// Area de Processo
			$this->db->select('ap.sigla, ap.nome, ap.descricao');
			$this->db->from('areaprocesso ap');
			$this->db->join('nivelmaturidade nm', 'ap.idNivelMaturidade', "nm.idNivelMaturidade");
			$this->db->where('ap.idModelo', $modelo->idModelo);
			$metasgenericas = $this->db->get();
			$table = array( );
		}
				
		$this->cezpdf->ezStream();
	}
		
}

?>