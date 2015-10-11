<?php namespace App\Models\Igmine;

use Illuminate\Database\Eloquent\Model;


/**
 * Class User
 * @package App\Models\Access\User
 */
class London extends Model {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'london';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Igmine\Tag', 'tags_images');
    }
}
