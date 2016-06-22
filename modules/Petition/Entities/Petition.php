<?php

namespace Modules\Petition\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Petition extends Model
{
    //
	use SoftDeletes;
	use \Stevebauman\EloquentTable\TableTrait;
	
    protected $primaryKey = 'id';
    protected $table = 'petition_petition';
	  
    protected $fillable = [  	
			'user_id',
			'title',
			'declaration',
			'slug',
			'sender',
			'receiver',
			'tags',
			'url',
			'category_id',
			'press',
			'titulo_eleitor',
			'address',
			'comment',
			'migrated'
		];
    
   public static $rules = [
                'title' => 'required|min:10|unique:petition_petition,title',
                'slug' => 'required|unique:petition_petition,slug',
								'description' => 'min:50',
								'image' => 'mimes:jpeg,jpg,png,gif|max:10000'
            ];
     
    public function user()
    {
        return $this->belongsTo('Modules\Admin\Entities\User', 'user_id');
    }
	
		public function category()
    {
        return $this->belongsTo('Modules\Petition\Entities\Category', 'category_id');
    }

		public function signature()
    {
        return $this->hasMany('Modules\Petition\Entities\Signature', 'petition_id');
    }
	
		public function report()
    {
        return $this->hasMany('Modules\Petition\Entities\Report', 'petition_id');
    }
	
		public function timeline()
    {
        return $this->hasMany('Modules\Petition\Entities\Timeline', 'petition_id');
    }

		public static function url_amigavel($string)
		{
				$table = array(
						'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z',
						'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
						'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
						'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
						'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
						'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
						'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
						'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
						'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
						'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
						'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
						'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
						'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
						'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
						'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
				);
				// Traduz os caracteres em $string, baseado no vetor $table
				$string = strtr($string, $table);
				// converte para minúsculo
				$string = strtolower($string);
				// remove caracteres indesejáveis (que não estão no padrão)
				$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
				// Remove múltiplas ocorrências de hífens ou espaços
				$string = preg_replace("/[\s-]+/", " ", $string);
				// Transforma espaços e underscores em hífens
				$string = preg_replace("/[\s_]/", "-", $string);
				// retorna a string
				return $string;
		}
}
