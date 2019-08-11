<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'kode',
        'stok',
        'harga',
        'nama',
        'deskripsi'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    /**
     * Get category object for this particular Barang object
     *
     * @return Category
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'id_categories');
    }

}
