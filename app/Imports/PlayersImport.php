<?php

namespace App\Imports;

use App\Models\Player; //Automatically imported since we added the model flag
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlayersImport implements ToModel, WithHeadingRow
{
    public $data;

    public function __construct()
    {
        $this->data = collect();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //return an eloquent object
        $model = Player::firstOrCreate([
            'name' => $row['name'],
        ], [
            'club' => $row['club'],
            'email' => $row['email'],
            'position' => $row['position'],
            'age' => $row['age'],
            'salary' => $row['salary']
        ]);

        $this->data->push($model);

        return $model;
    }
}
