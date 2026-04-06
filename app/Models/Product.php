<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','description','price','stock','category','sku','image','is_active'];
    protected $casts    = ['price'=>'integer','stock'=>'integer','is_active'=>'boolean'];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($p) => $p->slug = $p->slug ?? Str::slug($p->name));
    }

    public function cartItems()  { return $this->hasMany(Cart::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }

    public function getPriceFormattedAttribute(): string
    {
        return \App\Helpers\CurrencyHelper::rupiah($this->price);
    }

    public function isLowStock():   bool { return $this->stock > 0 && $this->stock <= 10; }
    public function isOutOfStock(): bool { return $this->stock <= 0; }

    public function scopeActive($q)            { return $q->where('is_active', true); }
    public function scopeCategory($q, $cat)    { return $q->where('category', $cat); }
}
