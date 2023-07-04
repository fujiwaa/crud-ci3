<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'RPS';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('tb_rps.*, tb_matkul.nama_matkul, tb_matkul.kode_matkul');
		$this->db->join('tb_matkul', 'tb_matkul.id = tb_rps.id_matkul');
		$this->db->join('tb_dosen', 'tb_dosen.id_dosen = tb_matkul.id_dosen');
        $data['menu'] = $this->db->get('tb_rps')->result_array();

        $this->db->group_by('kode_matkul');
        $matkuls = $this->db->get('tb_matkul')->result();

        $data['matkuls'] = $matkuls;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }
    
    // public function subMenu()
    // {
    //     $data['title'] = 'Submenu Management';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $this->load->model('Menu_model', 'menu');

    //     $data['subMenu'] = $this->menu->getSubMenu();
    //     $data['menu'] = $this->db->get('user_menu')->result_array();

    //     $this->form_validation->set_rules('title', 'Title', 'required');
    //     $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    //     $this->form_validation->set_rules('url', 'URL', 'required');
    //     $this->form_validation->set_rules('icon', 'Icon', 'required');
        
    // if($this->form_validation->run() == false) {
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('menu/submenu', $data);
    //     $this->load->view('templates/footer');
    //     } else {
    //         $data = [
    //             'title' => $this->input->post('title'),
    //             'menu_id' => $this->input->post('menu_id'),
    //             'url' => $this->input->post('url'),
    //             'icon' => $this->input->post('icon'),
    //             'is_active' => $this->input->post('is_active')
    //         ];
    //         $this->db->insert('user_sub_menu', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu Ditambahkan!</div>');
    //         redirect('menu/submenu');
    //     }
    // }

	public function detail_rps()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$data['title'] = "Detail RPS";
		//buat fungsi menampilkan rps
		$id = $this->input->get('id');
		$rps = $this->db->get_where('tb_rps', ['id' => $id])->row();

		$this->db->select('tb_matkul.*, tb_prodi.*, tb_fakultas.nama as nama_fakultas, tb_fakultas.id as id_fakultas');
		$this->db->from('tb_matkul');
		$this->db->join('tb_prodi', 'tb_prodi.id_prodi = tb_matkul.id_prodi');
		$this->db->join('tb_fakultas', 'tb_fakultas.id = tb_prodi.id_fakultas');
		$this->db->where('tb_matkul.id', $rps->id_matkul);
		$matkul = $this->db->get()->row();

		$this->db->select('tb_fakultas.*, tb_dosen.nama_dosen as nama_dekan, tb_dosen.nip as nip_dekan');
		$this->db->from('tb_fakultas');
		$this->db->join('tb_dosen', 'tb_dosen.id_dosen = tb_fakultas.id_dekan');
		$this->db->where('tb_fakultas.id', $matkul->id_fakultas);
		$fakultas = $this->db->get()->row();

		$this->db->select('tb_prodi.*, tb_dosen.nama_dosen as nama_kaprodi, tb_dosen.nip as nip_kaprodi');
		$this->db->from('tb_prodi');
		$this->db->join('tb_dosen', 'tb_dosen.id_dosen = tb_prodi.kaprodi');
		$this->db->where('tb_prodi.id_fakultas', $matkul->id_fakultas);
		$prodi = $this->db->get()->row();

		$this->db->select('tb_dosen.nama_dosen as nama_pembuat, tb_dosen.nip as nip_pembuat, tb_rps.*');
		$this->db->from('tb_dosen');
		$this->db->join('tb_rps', 'tb_rps.id_pembuat = tb_dosen.id_dosen');
		$this->db->where('tb_rps.id', $rps->id);
		$pembuat = $this->db->get()->row();

		$this->db->select('tb_prodi.*, tb_dosen.nama_dosen as nama_sekprodi, tb_dosen.nip as nip_sekprodi');
		$this->db->from('tb_prodi');
		$this->db->join('tb_dosen', 'tb_dosen.id_dosen = tb_prodi.sekprodi');
		$this->db->where('tb_prodi.id_fakultas', $matkul->id_fakultas);
		$sekprodi = $this->db->get()->row();

		$kode_matkul = $this->db->get_where('tb_matkul', ['id' => $rps->id_matkul])->row();
		$kode_matkul = $kode_matkul->kode_matkul;
		$this->db->select('tb_dosen.*, tb_matkul.id_dosen, tb_matkul.kode_matkul');
		$this->db->from('tb_dosen');
		$this->db->join('tb_matkul', 'tb_matkul.id_dosen = tb_dosen.id_dosen');
		$this->db->where('tb_matkul.kode_matkul', $kode_matkul);
		$dosen_pengampu = $this->db->get()->result();

		$unit_pembelajaran = $this->db->get_where('tb_rps_unit_pembelajaran', ['id_rps' => $rps->id])->result();

		$tugas_aktivitas = $this->db->get_where('tb_rps_tugas', ['id_rps' => $rps->id])->result();

		$rpp = $this->db->get_where('tb_rps_detail', ['id_rps' => $rps->id])->result();

		$data['matkul'] = $matkul;
		$data['rps'] = $rps;
		$data['fakultas'] = $fakultas;
		$data['prodi'] = $prodi;
		$data['pembuat'] = $pembuat;
		$data['sekprodi'] = $sekprodi;
		$data['dosen_pengampu'] = $dosen_pengampu;
		$data['unit_pembelajaran'] = $unit_pembelajaran;
		$data['tugas_aktivitas'] = $tugas_aktivitas;
		$data['rpp'] = $rpp;

		//get the latest tb_rps_detail
		$rpp_latest_check = $this->db->order_by('id', 'DESC')->get_where('tb_rps_detail', ['id_rps' => $rps->id])->row();
		if ($rpp_latest_check == null) {
			$rpp_latest = 0;
		} else {
			$rpp_latest = $rpp_latest_check->minggu;
		}
		//increment
		$rpp_latest = $rpp_latest + 1;
		$data['rpp_latest'] = $rpp_latest;

		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rps/detail', $data);
        $this->load->view('templates/footer');
	}

    public function tambah_rps_aksi()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$id_matkul = $this->input->post('id_matkul');
		$semester = $this->input->post('semester');
		$matkul = $this->db->get_where('tb_matkul', ['id' => $id_matkul])->row();
		$tanggal_berlaku = date('Y-m-d');
		$tanggal_disusun = date('Y-m-d');
        $id_user = $this->session->userdata('email');
		$this->db->join('user', 'user.id_dosen = tb_dosen.id_dosen');
		$id_pembuat = $this->input->post('id_pembuat');
		$revisi = "00";
		$bobot_sks = $this->input->post('bobot_sks');
		$detail_penilaian = $this->input->post('detail_penilaian');
		$gambaran_umum = $this->input->post('gambaran_umum');
		$capaian = $this->input->post('capaian');
		$prasyarat = $this->input->post('prasyarat');

		$nomor = "RPS-$matkul->kode_matkul";
		//action to input tb_rps
		$data = [
			'id_matkul' => $id_matkul,
			'semester' => $semester,
			'nomor' => $nomor,
			'tanggal_berlaku' => $tanggal_berlaku,
			'tanggal_disusun' => $tanggal_disusun,
			'id_pembuat' => $id_matkul,
			'revisi' => $revisi,
			'bobot_sks' => $bobot_sks,
			'detail_penilaian' => $detail_penilaian,
			'gambaran_umum' => $gambaran_umum,
			'capaian' => $capaian,
			'prasyarat' => $prasyarat,
		];

		$this->db->insert('tb_rps', $data);
		$id_rps = $this->db->insert_id();
		//return redirect to detail_rps
		$id = $id_rps;
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">RPS berhasil ditambahkan</div>');
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function delete(){
		
		$id_rps = $this->input->get('id');

		$this->db->delete('tb_rps', [
			'id' => $id_rps
		]);

		
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">RPS berhasil dihapus</div>');
		return redirect('menu');
	}

	public function tambah_unit_pembelajaran()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id_rps = $this->input->post('id_rps');
		$kemampuan_akhir = $this->input->post('kemampuan_akhir');
		$indikator = $this->input->post('indikator');
		$bahan_kajian = $this->input->post('bahan_kajian');
		$metode_pembelajaran = $this->input->post('metode_pembelajaran');
		$waktu = $this->input->post('waktu');
		$metode_penilaian = $this->input->post('metode_penilaian');
		$bahan_ajar = $this->input->post('bahan_ajar');


		$data = [
			'id_rps' => $id_rps,
			'kemampuan_akhir' => $kemampuan_akhir,
			'indikator' => $indikator,
			'bahan_kajian' => $bahan_kajian,
			'metode_pembelajaran' => $metode_pembelajaran,
			'waktu' => $waktu,
			'metode_penilaian' => $metode_penilaian,
			'bahan_ajar' => $bahan_ajar,
		];

		$this->db->insert('tb_rps_unit_pembelajaran', $data);
		$id = $id_rps;
		return redirect('dosen/detail_rps?id=' . $id);
    }
	
	public function edit_unit_pembelajaran()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id = $this->input->post('id');
		$id_rps = $this->input->post('id_rps');
		$kemampuan_akhir = $this->input->post('kemampuan_akhir');
		$indikator = $this->input->post('indikator');
		$bahan_kajian = $this->input->post('bahan_kajian');
		$metode_pembelajaran = $this->input->post('metode_pembelajaran');
		$waktu = $this->input->post('waktu');
		$metode_penilaian = $this->input->post('metode_penilaian');
		$bahan_ajar = $this->input->post('bahan_ajar');

		//edit
		$data = [
			'kemampuan_akhir' => $kemampuan_akhir,
			'indikator' => $indikator,
			'bahan_kajian' => $bahan_kajian,
			'metode_pembelajaran' => $metode_pembelajaran,
			'waktu' => $waktu,
			'metode_penilaian' => $metode_penilaian,
			'bahan_ajar' => $bahan_ajar,
		];

		$this->db->where('id', $id);
		$this->db->update('tb_rps_unit_pembelajaran', $data);
		$id = $id_rps;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function hapus_unit_pembelajaran()
	{
		$id = $this->input->post('id');
		$id_rps = $this->input->post('id_rps');
		$this->db->where('id', $id);
		$this->db->delete('tb_rps_unit_pembelajaran');
		$id = $id_rps;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function tambah_tugas_rps()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id_rps = $this->input->post('id_rps');
		$tugas = $this->input->post('tugas');
		$kemampuan_akhir = $this->input->post('kemampuan_akhir');
		$waktu = $this->input->post('waktu');
		$bobot 		= $this->input->post('bobot');
		$kriteria_penilaian = $this->input->post('kriteria_penilaian');
		$indikator_penilaian = $this->input->post('indikator_penilaian');

		$data = [
			'id_rps' => $id_rps,
			'tugas' => $tugas,
			'kemampuan_akhir' => $kemampuan_akhir,
			'waktu' => $waktu,
			'bobot' => $bobot,
			'kriteria_penilaian' => $kriteria_penilaian,
			'indikator_penilaian' => $indikator_penilaian,
		];

		$this->db->insert('tb_rps_tugas', $data);
		$id = $id_rps;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function edit_tugas_rps()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id = $this->input->post('id');
		$id_rps = $this->input->post('id_rps');
		$tugas = $this->input->post('tugas');
		$kemampuan_akhir = $this->input->post('kemampuan_akhir');
		$waktu = $this->input->post('waktu');
		$bobot 		= $this->input->post('bobot');
		$kriteria_penilaian = $this->input->post('kriteria_penilaian');
		$indikator_penilaian = $this->input->post('indikator_penilaian');

		$data = [
			'tugas' => $tugas,
			'kemampuan_akhir' => $kemampuan_akhir,
			'waktu' => $waktu,
			'bobot' => $bobot,
			'kriteria_penilaian' => $kriteria_penilaian,
			'indikator_penilaian' => $indikator_penilaian,
		];

		$this->db->where('id', $id);
		$this->db->update('tb_rps_tugas', $data);
		$id = $id_rps;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function hapus_tugas_rps()
	{
		$id = $this->input->post('id');
		$id_rps = $this->input->post('id_rps');
		$this->db->where('id', $id);
		$this->db->delete('tb_rps_tugas');
		$id = $id_rps;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function tambah_rpp()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id_rps = $this->input->post('id_rps');
		$minggu = $this->input->post('minggu');
		$kemampuan_akhir = $this->input->post('kemampuan_akhir');
		$indikator = $this->input->post('indikator');
		$topik = $this->input->post('topik');
		$aktivitas_pembelajaran = $this->input->post('aktivitas_pembelajaran');
		$waktu = $this->input->post('waktu');
		$penilaian = $this->input->post('penilaian');

		$data = [
			'id_rps' => $id_rps,
			'minggu' => $minggu,
			'kemampuan_akhir' => $kemampuan_akhir,
			'indikator' => $indikator,
			'topik' => $topik,
			'aktivitas_pembelajaran' => $aktivitas_pembelajaran,
			'waktu' => $waktu,
			'penilaian' => $penilaian,
		];

		$this->db->insert('tb_rps_detail', $data);
		$id = $id_rps;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function edit_rpp()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id = $this->input->post('id');
		$id_rps = $this->input->post('id_rps');
		$minggu = $this->input->post('minggu');
		$kemampuan_akhir = $this->input->post('kemampuan_akhir');
		$indikator = $this->input->post('indikator');
		$topik = $this->input->post('topik');
		$aktivitas_pembelajaran = $this->input->post('aktivitas_pembelajaran');
		$waktu = $this->input->post('waktu');
		$penilaian = $this->input->post('penilaian');

		$data = [
			'minggu' => $minggu,
			'kemampuan_akhir' => $kemampuan_akhir,
			'indikator' => $indikator,
			'topik' => $topik,
			'aktivitas_pembelajaran' => $aktivitas_pembelajaran,
			'waktu' => $waktu,
			'penilaian' => $penilaian,
		];

		$this->db->where('id', $id);
		$this->db->update('tb_rps_detail', $data);
		$id = $id_rps;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function hapus_rpp()
	{
		$id = $this->input->post('id');
		$id_rps = $this->input->post('id_rps');
		$this->db->where('id', $id);
		$this->db->delete('tb_rps_detail');
		$id = $id_rps;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function edit_penilaian_rps()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id = $this->input->post('id');
		$detail_penilaian = $this->input->post('detail_penilaian');
		$data = [
			'detail_penilaian' => $detail_penilaian
		];
		$this->db->where('id', $id);
		$this->db->update('tb_rps', $data);
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Detail penilaian berhasil diubah</div>');
		$id = $id;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function edit_gambaran_umum_rps()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id = $this->input->post('id');
		$gambaran_umum = $this->input->post('gambaran_umum');
		$data = [
			'gambaran_umum' => $gambaran_umum
		];
		$this->db->where('id', $id);
		$this->db->update('tb_rps', $data);
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gambaran umum berhasil diubah</div>');
		$id = $id;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function edit_capaian_rps()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id = $this->input->post('id');
		$capaian = $this->input->post('capaian');
		$data = [
			'capaian' => $capaian
		];
		$this->db->where('id', $id);
		$this->db->update('tb_rps', $data);
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Capaian berhasil diubah</div>');
		$id = $id;
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function edit_prasyarat_rps()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id = $this->input->post('id');
		$prasyarat = $this->input->post('prasyarat');
		$data = [
			'prasyarat' => $prasyarat
		];
		$this->db->where('id', $id);
		$this->db->update('tb_rps', $data);
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Prasyarat berhasil diubah</div>');
		return redirect('menu/detail_rps?id=' . $id);
	}

	public function cetak_rps()
	{
		$data['menu'] = $this->db->get('tb_rps')->result_array();
		$id = $this->input->get('id');
		$rpss = $this->db->get_where('tb_rps', ['id' => $id])->row();
		$rps = $this->db->get_where('tb_rps_detail', ['id_rps' => $rpss->id]);

		$this->db->select('tb_matkul.*, tb_prodi.*, tb_fakultas.nama as nama_fakultas, tb_fakultas.id as id_fakultas');
		$this->db->from('tb_matkul');
		$this->db->join('tb_prodi', 'tb_prodi.id_prodi = tb_matkul.id_prodi');
		$this->db->join('tb_fakultas', 'tb_fakultas.id = tb_prodi.id_fakultas');
		$this->db->where('tb_matkul.id', $rpss->id_matkul);
		$matkul = $this->db->get()->row();

		$this->db->select('tb_fakultas.*, tb_dosen.nama_dosen as nama_dekan, tb_dosen.nip as nip_dekan');
		$this->db->from('tb_fakultas');
		$this->db->join('tb_dosen', 'tb_dosen.id_dosen = tb_fakultas.id_dekan');
		$this->db->where('tb_fakultas.id', $matkul->id_fakultas);
		$fakultas = $this->db->get()->row();

		$this->db->select('tb_prodi.*, tb_dosen.nama_dosen as nama_kaprodi, tb_dosen.nip as nip_kaprodi');
		$this->db->from('tb_prodi');
		$this->db->join('tb_dosen', 'tb_dosen.id_dosen = tb_prodi.kaprodi');
		$this->db->where('tb_prodi.id_fakultas', $matkul->id_fakultas);
		$prodi = $this->db->get()->row();

		$this->db->select('tb_dosen.nama_dosen as nama_pembuat, tb_dosen.nip as nip_pembuat, tb_rps.*');
		$this->db->from('tb_dosen');
		$this->db->join('tb_rps', 'tb_rps.id_pembuat = tb_dosen.id_dosen');
		$this->db->where('tb_rps.id', $rpss->id);
		$pembuat = $this->db->get()->row();

		$this->db->select('tb_prodi.*, tb_dosen.nama_dosen as nama_sekprodi, tb_dosen.nip as nip_sekprodi');
		$this->db->from('tb_prodi');
		$this->db->join('tb_dosen', 'tb_dosen.id_dosen = tb_prodi.sekprodi');
		$this->db->where('tb_prodi.id_fakultas', $matkul->id_fakultas);
		$sekprodi = $this->db->get()->row();

		$kode_matkul = $this->db->get_where('tb_matkul', ['id' => $rpss->id_matkul])->row();
		$kode_matkul = $kode_matkul->kode_matkul;
		$this->db->select('tb_dosen.*, tb_matkul.id_dosen, tb_matkul.kode_matkul');
		$this->db->from('tb_dosen');
		$this->db->join('tb_matkul', 'tb_matkul.id_dosen = tb_dosen.id_dosen');
		$this->db->where('tb_matkul.kode_matkul', $kode_matkul);
		$dosen_pengampu = $this->db->get()->result();

		$unit_pembelajaran = $this->db->get_where('tb_rps_unit_pembelajaran', ['id_rps' => $rpss->id])->result();

		$tugas_aktivitas = $this->db->get_where('tb_rps_tugas', ['id_rps' => $rpss->id])->result();

		$minggu = array();
		$kemampuan_akhir = array();
		$indikator = array();
		$topik = array();
		$aktivitas_pembelajaran = array();
		$waktu = array();
		$penilaian = array();

		# Loop over all the fetched data, and save the
		# data in array.
		foreach ($rps->result_array() as $row) {
			array_push($minggu, $row['minggu']);
			array_push($kemampuan_akhir, $row['kemampuan_akhir']);
			array_push($indikator, $row['indikator']);
			array_push($topik, $row['topik']);
			array_push($aktivitas_pembelajaran, $row['aktivitas_pembelajaran']);
			array_push($waktu, $row['waktu']);
			array_push($penilaian, $row['penilaian']);
		}

		$kemampuan_arr = array();

		# loop over all the sal array
		for ($i = 0; $i < sizeof($minggu); $i++) {
			$kemampuanName = $kemampuan_akhir[$i];

			# If there is no array for the employee
			# then create a elemnt.
			if (!isset($kemampuan_arr[$kemampuanName])) {
				$kemampuan_arr[$kemampuanName] = array();
				$kemampuan_arr[$kemampuanName]['rowspan'] = 0;
			}

			$kemampuan_arr[$kemampuanName]['printed'] = "no";

			# Increment the row span value.
			$kemampuan_arr[$kemampuanName]['rowspan'] += 1;
		}
		$arr_indikator = array();
		# loop over all the sal array
		for ($i = 0; $i < sizeof($minggu); $i++) {
			$indikatorName = $indikator[$i];

			# If there is no array for the employee
			# then create a elemnt.
			if (!isset($arr_indikator[$indikatorName])) {
				$arr_indikator[$indikatorName] = array();
				$arr_indikator[$indikatorName]['rowspan'] = 0;
			}

			$arr_indikator[$indikatorName]['printed'] = "no";

			# Increment the row span value.
			$arr_indikator[$indikatorName]['rowspan'] += 1;
		}
		$topik_arr = array();
		# loop over all the sal array
		for ($i = 0; $i < sizeof($minggu); $i++) {
			$topikName = $topik[$i];

			# If there is no array for the employee
			# then create a elemnt.
			if (!isset($topik_arr[$topikName])) {
				$topik_arr[$topikName] = array();
				$topik_arr[$topikName]['rowspan'] = 0;
			}

			$topik_arr[$topikName]['printed'] = "no";

			# Increment the row span value.
			$topik_arr[$topikName]['rowspan'] += 1;
		}
		$aktivitas_arr = array();
		# loop over all the sal array
		for ($i = 0; $i < sizeof($minggu); $i++) {
			$aktivitasName = $aktivitas_pembelajaran[$i];

			# If there is no array for the employee
			# then create a elemnt.
			if (!isset($aktivitas_arr[$aktivitasName])) {
				$aktivitas_arr[$aktivitasName] = array();
				$aktivitas_arr[$aktivitasName]['rowspan'] = 0;
			}

			$aktivitas_arr[$aktivitasName]['printed'] = "no";

			# Increment the row span value.
			$aktivitas_arr[$aktivitasName]['rowspan'] += 1;
		}
		$waktu_arr = array();
		# loop over all the sal array
		for ($i = 0; $i < sizeof($minggu); $i++) {
			$waktuName = $waktu[$i];

			# If there is no array for the employee
			# then create a elemnt.
			if (!isset($waktu_arr[$waktuName])) {
				$waktu_arr[$waktuName] = array();
				$waktu_arr[$waktuName]['rowspan'] = 0;
			}

			$waktu_arr[$waktuName]['printed'] = "no";

			# Increment the row span value.
			$waktu_arr[$waktuName]['rowspan'] += 1;
		}
		$penilaian_arr = array();
		# loop over all the sal array
		for ($i = 0; $i < sizeof($minggu); $i++) {
			$penilaianName = $penilaian[$i];

			# If there is no array for the employee
			# then create a elemnt.
			if (!isset($penilaian_arr[$penilaianName])) {
				$penilaian_arr[$penilaianName] = array();
				$penilaian_arr[$penilaianName]['rowspan'] = 0;
			}

			$penilaian_arr[$penilaianName]['printed'] = "no";

			# Increment the row span value.
			$penilaian_arr[$penilaianName]['rowspan'] += 1;
		}

		$data['kemampuan_arr'] = $kemampuan_arr;
		$data['minggu'] = $minggu;
		$data['kemampuan_akhir'] = $kemampuan_akhir;
		$data['indikator_arr'] = $arr_indikator;
		$data['indikator'] = $indikator;
		$data['topik_arr'] = $topik_arr;
		$data['topik'] = $topik;
		$data['aktivitas_arr'] = $aktivitas_arr;
		$data['aktivitas_pembelajaran'] = $aktivitas_pembelajaran;
		$data['waktu_arr'] = $waktu_arr;
		$data['waktu'] = $waktu;
		$data['penilaian_arr'] = $penilaian_arr;
		$data['penilaian'] = $penilaian;
		$data['matkul'] = $matkul;
		$data['rps'] = $rpss;
		$data['fakultas'] = $fakultas;
		$data['prodi'] = $prodi;
		$data['pembuat'] = $pembuat;
		$data['sekprodi'] = $sekprodi;
		$data['dosen_pengampu'] = $dosen_pengampu;
		$data['unit_pembelajaran'] = $unit_pembelajaran;
		$data['tugas_aktivitas'] = $tugas_aktivitas;

		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = $rpss->nomor . ".pdf";
		$this->pdf->load_view('rps/cetak', $data);
	}
}