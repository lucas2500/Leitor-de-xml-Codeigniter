<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_model extends CI_model {


	public function insertVenda($dados=NULL){

		if($dados != NULL):
			$this->db->insert('venda', $dados);

		endif;


	}

	public function getVenda(){

		$this->db->order_by('ID', 'DESC');
		$query = $this->db->get('venda');

		return $query->result();

	}

	public function getReg($ID=NULL){

		if($ID != NULL):
			
			$query = $this->db->get_where('venda', array('ID' => $ID));

			return $query->row();

		endif;

	}

	public function deleteReg($ID=NULL){

		if($ID != NULL):

			$this->db->delete('venda', array('ID' => $ID));

		endif;

	}

}


