<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Contrat extends Model 
{
    public function client()
    {
        return $this->belongsTo('\App\Client');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'energy', 'product', 'gsm', 'duration', 'codePromo', 'client_id'
    ];
    /**
     * The attributes that are excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
