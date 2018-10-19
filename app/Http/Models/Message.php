<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestController;

class Message extends Model
{
    
protected $fillable = ['message'];

protected $table = 'messages';
}
