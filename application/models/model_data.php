<?php

class Model_data extends CI_Model
{
	function insert($data,$table)
	{
		return $this->db->insert($table,$data);
	}
	function cek($where,$table)
	{
		$query = $this->db->get_where($table,$where);
		return $query->row_array();
	}
	function ambil_user($where,$table)
	{
		$query = $this->db->get_where($table,$where);
		return $query->row_array();
	}

	public function ambil_data()
	{
		$this->db->select( 'bulan_pemakaian as bulan');
		$this->db->select( 'tahun_pemakaian as tahun');
		$this->db->select( 'jumlah_pemakaian as _y');
		$this->db->select( '0 as _x');
		$this->db->select( '0 as _xx');
		$this->db->select( '0 as _xy');
		$this->db->order_by('tahun_pemakaian', 'ASC');
		$this->db->order_by('bulan_pemakaian', 'ASC');
		return $this->db->get( 'data_pemakaian_air')->result();
		// $this->db->select( '' );
	}
}
?>