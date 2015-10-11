<?php namespace App\Models\Igmine;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function london()
    {
        return $this->belongsToMany('App\Models\Igmine\London', 'tags_images');
    }
}
