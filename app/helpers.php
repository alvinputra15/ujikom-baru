
<?php

use Illuminate\Support\Facades\DB;

function autonumber($table,$kolom,$lebar = 0, $awalan)
{
       $latesRecord = DB::table($table)->orderBy($kolom, 'desc')->first();

       if (!$latesRecord) {
        $nomor = 1;
       } else{
        $nomor = intval(substr($latesRecord->$kolom, strlen($awalan))) + 1;
       }

       if ($lebar > 0){
        $angka = $awalan . str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
       } else{
        $angka = $awalan . $nomor;
       }

       return $angka;
}
