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

		$path = "./uploads/";
		if ( ! is_dir($path)) {
			mkdir($path, 0777, $recursive = true);
		}

		$configUpload['upload_path']   = $path;
		$configUpload['allowed_types'] = 'pptx|docx|pdf|zip|rar|doc|xml';
		$configUpload['encrypt_name']  = FALSE;
		$this->upload->initialize($configUpload);
		if ($this->upload->do_upload('arquivo')){

			$arquivo = $this->upload->data();

			$data2['nome'] = $arquivo['raw_name'].$arquivo['file_ext'];


		} else{

			echo "Erro no upload";

		}


		$file = $path.$data2['nome'];

		$xmldoc = new DOMDocument();
		$xmldoc ->load($file);

		$xmldata = $xmldoc->getElementsByTagName('dest');
		// $xmldata2 = $xmldoc->getElementsByTagName('prod');

		$xmlcount = $xmldata->length;

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
