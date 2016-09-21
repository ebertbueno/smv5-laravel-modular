<?php namespace Modules\Api\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Client extends Model {

	protected $table = 'oauth_clients';
    protected $fillable = ['id', 'name', 'secret'];

}