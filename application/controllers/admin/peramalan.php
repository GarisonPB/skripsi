<?php

class Peramalan extends CI_Controller
{
	public function index()
	{        
		$this->load->model('model_data');
		$data = $this->model_data->ambil_data();

		$results = array();
		if (count($data) % 2 == 0) {
			$results = $this->perhitungan_genap($data);
		} else {
			$results = $this->perhitungan_ganjil($data);
		}
		
		
		$data['results'] = $results;


		$this->load->view('admin/v_admin_side_navbar' );        
		$this->load->view('admin/v_admin_top_navbar');         
		$this->load->view('admin/peramalan/v_peramalan', $data);

	}


	function perhitungan_ganjil($data) {
		$_n = count( $data );
		$_mid = ( ( $_n - 1 ) / 2 ) + 1;

		$nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

		$sum_x 		= 0;
		$sum_y 		= 0;
		$sum_xx 	= 0;
		$sum_xy 	= 0;

		$bulan = '';
		$tahun = '';
		$results = array();

		for( $i =0 , $_x = ( $_mid - 1 ) * -1; $_x <= ( $_mid - 1 ), $i < $_n ; $_x++, $i++ )
		{
			$sum_x += $_x;
			$sum_y += $data[$i]->_y;
			$sum_xx += ( $_x*$_x );
			$sum_xy += ( $_x*$data[$i]->_y );

			$data[$i]->_x = $_x;
			$data[$i]->_xx = ( $_x*$_x );
			$data[$i]->_xy = ( $_x*$data[$i]->_y );

			$a = $sum_y / $_n;
			$b = $sum_xy / $sum_xx ;
			$_y_accent = $a +( $b * $_mid ) ;
			
			array_push($results, (object)array(
				'next_x' => $_mid,
				'_n' => $_n,
				'x' => $sum_x,
				'y' => $sum_y,
				'a' => $a,
				'b' => $b,
				'_y_accent' => $_y_accent,
				'bulan' => $nama_bulan[$data[$i]->bulan-1],
				'tahun' => $data[$i]->tahun, 
			)
			);
		}
		return $results;
	}

	function perhitungan_genap($data) {
		$_n = count( $data );
		$_mid = $_n / 2;

		$nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

		$sum_x 		= 0;
		$sum_y 		= 0;
		$sum_xx 	= 0;
		$sum_xy 	= 0;

		$bulan = '';
		$tahun = '';
		$results = array();

		for( $i =0 , $_x = ( $_mid * 2 - 1 ) * -1; $_x <= ( $_mid * 2 - 1 ) , $i < $_n ; $_x+= 2 , $i++ )
		{
			$sum_x += $_x;
			$sum_y += $data[$i]->_y;
			$sum_xx += ( $_x*$_x );
			$sum_xy += ( $_x*$data[$i]->_y );

			$data[$i]->_x = $_x;
			$data[$i]->_xx = ( $_x*$_x );
			$data[$i]->_xy = ( $_x*$data[$i]->_y );

			$a = $sum_y / $_n;
			$b = $sum_xy / $sum_xx;
			$_y_accent = $a +( $b * $_n ) ;
			
			array_push($results, (object)array(
				'next_x' => $_mid*2 +1,
				'_n' => $_n,
				'x' => $sum_x,
				'y' => $sum_y,
				'a' => $a,
				'b' => $b,
				'_y_accent' => $_y_accent,
				'bulan' => $nama_bulan[$data[$i]->bulan-1],
				'tahun' => $data[$i]->tahun, 
			)
			);
		}
		return $results;
	}
}