<?php

namespace Database\Seeders\traits;

use Illuminate\Support\Facades\DB;

trait DisableForeignKeys
{
    public function disableForeignKeys()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0') ;
    }

    public function enableForeignKeys()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1') ;
    }

}
