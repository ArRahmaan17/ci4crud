<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email', 'bidang', 'alamat'];

    public function cari($katakunci)
    {
        $builder = $this->table("pegawai");
        $arr_katakunci = explode(" ", $katakunci);
        for ($x=0; $x < count($arr_katakunci) ; $x++) { 
            $builder->orLike("nama", $arr_katakunci[$x]);
            $builder->orLike("email", $arr_katakunci[$x]);
            $builder->orLike("alamat", $arr_katakunci[$x]);
            $builder->orLike("bidang", $arr_katakunci[$x]);
        }
        return $builder;
    }
}
