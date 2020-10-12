<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $table = 'imports';
    protected $guarded = [];

    public function ImportToDb()
    {
        $path = resource_path('pending-files/*.csv');

        $g = glob($path);


        foreach(array_slice($g, 0, 1) as $file)
        {
            $data = array_map('str_getcsv', file($file));

            foreach($data as $row)
            {
                self::Create([
                    'date' =>$row[0],
                    'storecode' =>$row[1]

                ]

                );

            }
            unlink($file);
        }
    }
}
