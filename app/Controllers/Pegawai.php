<?php

namespace App\Controllers;

use App\Models\ModelPegawai;
use CodeIgniter\Config\Config;
use Config\Services;

class Pegawai extends BaseController
{

    public function __construct()
    {
        $this->pegawai = new ModelPegawai();
    }
    public function hapus($id)
    {
        $this->pegawai->delete($id);
        return redirect()->to(base_url());
    }
    public function edit($id)
    {
        return json_encode($this->pegawai->find($id));
    }
    public function simpan()
    {
        $validation = \Config\Services::validation();
        $aturan = [
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|min_length[8]|max_length[50]',
                'errors' => [
                    'required' => 'Field {field} Harus Di isi',
                    'min_length' => 'Minimum Panjang Karakter Field {field} Adalah 5',
                    'max_length' => 'Maximal Panjang Karakter Field {field} Adalah 50'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|min_length[8]|valid_email',
                'errors' => [
                    'required' => 'Field {field} Harus Di isi',
                    'min_length' => 'Minimum Panjang Karakter Field {field} Adalah 5',
                    'valid_email' => 'Email yang anda masukan tidak Valid',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[8]|max_length[50]',
                'errors' => [
                    'required' => 'Field {field} Harus Di isi',
                    'min_length' => 'Minimum Panjang Karakter Field {field} Adalah 5',
                    'max_length' => 'Maximal Panjang Karakter Field {field} Adalah 50'
                ]
            ],
        ];

        $validation->setRules($aturan);

        if ($validation->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $bidang = $this->request->getPost('bidang');
            $alamat = $this->request->getPost('alamat');

            $data = [
                'id' => $id,
                'nama' => $nama,
                'email' => $email,
                'bidang' => $bidang,
                'alamat' => $alamat
            ];
            $this->pegawai->save($data);

            $hasil['status'] = true;
            $hasil['pesan'] = 'Data Berhasil Ditambahkan';
        } else {
            $hasil['status'] = false;
            $hasil['pesan'] = $validation->listErrors();
        }
        return json_encode($hasil);
    }
    public function index()
    {
        $katakunci = $this->request->getVar('katakunci');
        if ($katakunci) {
            $pencaraian = $this->pegawai->cari($katakunci);
        }else{
            $pencaraian = $this->pegawai;
        }
        return view('pegawai_view', [
            'title' => 'Data Pegawai',
            'nomer' => ($this->request->getVar('page') == 1 )? '0' : $this->request->getVar('page'),
            'katakunci' => $this->request->getVar('katakunci'),
            'data' => $pencaraian->orderBy('id', 'desc')->paginate(3),
            'pager' => $this->pegawai->pager
        ]);
    }
}
