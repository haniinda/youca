<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Advs
 * @package App\Models
 */
class Advs extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='advs';
    protected $fillable=[
        'location' , 'working_hour' , 'e-date' , 's-date',
        'category_id','cost' , 'picture' , 'explaining' , 'advservice_id','user_id'
    ];
   // protected $guarded = ['id'];


    public function user(){
        return $this->belongsTo(User::class ,"user_id");
    }


    public function Adverservice(){
        return $this->belongsTo(Advservice::class,"advservice_id");
    }


    public function Category(){
       return $this->hasManyThrough( 'App\Models\Category'
           , 'App\Models\AdvserviceCategory' , '');
    }

    public function CurrentCategory(){
        return $this->belongsTo(Category::class , "category_id");
    }
}
