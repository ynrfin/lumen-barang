<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    /**
     * undocumented function
     *
     * @return void
     */
    public function barangs()
    {
        return $this->hasMany('App\Barang', 'id_categories');
    }
    
}
