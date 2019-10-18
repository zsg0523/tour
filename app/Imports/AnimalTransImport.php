<?php

namespace App\Imports;

use App\Models\AnimalTranslation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnimalTransImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AnimalTranslation([
            'animal_id'    => $row['animal_id'],
            'sound_id'     => $row['sound_id'],
            'lang'     => $row['lang'],
            'view'     => $row['view'],
            'title'     => $row['title'],
            'genus'     => $row['genus'],
            'family'     => $row['family'],
            'habitat'     => $row['habitat'],
            'location'     => $row['location'],
            'title_classification'     => $row['title_classification'],
            'classification'     => $row['classification'],
            'title_lifespan'     => $row['title_lifespan'],
            'lifespan'     => $row['lifespan'],
            'title_diet'     => $row['title_diet'],
            'diet'     => $row['diet'],
            'weight'     => $row['weight'],
            'speed'     => $row['speed'],
            'animal_height'     => $row['animal_height'],
            'title_fun_tips'     => $row['title_fun_tips'],
            'fun_tips'     => $row['fun_tips'],
            'endangered_level'     => $row['endangered_level'],
            'theme_name'     => $row['theme_name'],
            'group_name'     => $row['group_name'],
        ]);
    }
}
