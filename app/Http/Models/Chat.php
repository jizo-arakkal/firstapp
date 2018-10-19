<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestController;

class Chat extends Model
{
    
     public function __construct()
    {
        $this->rest = new RestController();        
    }
    
    protected $table = 'chats';

}