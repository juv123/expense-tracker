<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model { 
    use HasFactory;
    protected $table='expenses_categories';
    protected $fillable=["category_name","description"];
    public function expenses()
{
    return $this->hasMany(Expense::class);
}

}
?>