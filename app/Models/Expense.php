<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Expense extends Model { 
    use HasFactory;
      protected $fillable=["user_id","category_id","amount","description","date_of_expense"];
        public function category(){
        return $this->belongsTo(Category::class); //expense belongs to a category
    }
   
}
?>