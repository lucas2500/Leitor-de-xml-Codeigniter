<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('cadastro_model', 'cad');

	}


	public function index(){

		$data['regs'] = $this->cad->getVenda();

		$this->load->view('arquivo', $data);

	}


	public function insertData(){

		// Salvo o arquivo xml em um diretório
		$path = "./uploads/";
		if ( ! is_dir($path)) {
			mkdir($path, 0777, $recursive = true);
		}

		$configUpload['upload_path']   = $path;
		$configUpload['allowed_types'] = 'xml';
		$configUpload['encrypt_name']  = FALSE;
		$this->upload->initialize($configUpload);
		if ($this->upload->do_upload('arquivo')){

			// recupero o nome do arquivo
			$arquivo = $this->upload->data();

			$data2['nome'] = $arquivo['raw_name'].$arquivo['file_ext'];


		} else{

			echo "Erro no upload";

		}


		// recupero o arquivo do diretório usando o nome
		$file = $path.$data2['nome'];

		// carrego o arquivo recuperado
		$xmldoc = new DOMDocument();
		$xmldoc ->load($file);

		// carrego a tag do xml
		$xmldata = $xmldoc->getElementsByTagName('dest');

		// Inicializado a variável responsável pelo loop
		$xmlcount = $xmldata->length;

		// delete o arquivo do servidor
		unlink("./uploads/".$data2['nome']);

		for ($i=0; $i <$xmlcount; $i++) {


			$data['xNome'] = $xmldata->item($i)->getElementsByTagName('xNome')->item(0)->childNodes->item(0)->nodeValue;
			$data['CNPJ'] = $xmldata->item($i)->getElementsByTagName('CNPJ')->item(0)->childNodes->item(0)->nodeValue;
			$data['xLgr'] = $xmldata->item($i)->getElementsByTagName('xLgr')->item(0)->childNodes->item(0)->nodeValue;
			$data['nro'] = $xmldata->item($i)->getElementsByTagName('nro')->item(0)->childNodes->item(0)->nodeValue;
			$data['xBairro'] = $xmldata->item($i)->getElementsByTagName('xBairro')->item(0)->childNodes->item(0)->nodeValue;
			$data['xMun'] = $xmldata->item($i)->getElementsByTagName('xMun')->item(0)->childNodes->item(0)->nodeValue;
			$data['UF'] = $xmldata->item($i)->getElementsByTagName('UF')->item(0)->childNodes->item(0)->nodeValue;

			$this->cad->insertVenda($data);

			redirect("cadastro/index");


		}


	}

	public function deleteRegistro($ID=NULL){

		if($ID == NULL){

			redirect("cadastro/index");

		}

		$query = $this->cad->getReg($ID);

		if($query != NULL){

			$this->cad->deleteReg($query->ID);

		}

		redirect("cadastro/index");


	}
	
}
