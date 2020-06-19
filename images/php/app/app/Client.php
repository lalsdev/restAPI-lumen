<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Client extends Model
{
    public function contrats()
    {
        return $this->hasMany('\App\Contrat');
    }

    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'firstName', 'lastName', 'street', 'number', 'zip', 'city'
    ];

      /**
     * The attributes that are excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
