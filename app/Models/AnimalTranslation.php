<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalTranslation extends Model
{
    protected $guarded = [];

    protected $table = 'animals_translations';

    public function animal()
    {
    	return $this->belongsTo(Animal::class);
    }

    public function sound()
    {
    	return $this->belongsTo(Sound::class);
    }

    /** [getGroupNameAttribute 设置所有其他语言 group_name 默认为英文的] */
    public function getGroupNameAttribute($value)
    {
        $translation = $this->where('animal_id', $this->animal_id)
                            ->where('lang', 'en')
                            ->first('group_name');

        return $this->attributes['group_name'] = $translation->attributes['group_name'];
    }


}
