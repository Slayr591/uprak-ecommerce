<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id','order_number','status','payment_method','payment_status',
        'payment_proof','subtotal','shipping_cost','tax','total',
        'shipping_name','shipping_phone','shipping_address','shipping_city',
        'shipping_postal','shipping_method','notes','confirmed_by','confirmed_at',
    ];
    protected $casts = [
        'subtotal'=>'integer','shipping_cost'=>'integer','tax'=>'integer','total'=>'integer',
        'confirmed_at'=>'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($o) => $o->order_number = '#ORD-' . strtoupper(substr(uniqid(), -6)));
    }

    public function user()        { return $this->belongsTo(User::class); }
    public function items()       { return $this->hasMany(OrderItem::class); }
    public function confirmedBy() { return $this->belongsTo(User::class, 'confirmed_by'); }

    public function getTotalFormattedAttribute(): string
    {
        return \App\Helpers\CurrencyHelper::rupiah($this->total);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'Menunggu',
            'paid'      => 'Dibayar',
            'confirmed' => 'Dikonfirmasi',
            'shipped'   => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default     => $this->status,
        };
    }

    public function getPaymentStatusLabelAttribute(): string
    {
        return match($this->payment_status) {
            'unpaid'               => 'Belum Bayar',
            'pending_verification' => 'Menunggu Verifikasi',
            'paid'                 => 'Lunas',
            'rejected'             => 'Ditolak',
            default                => $this->payment_status,
        };
    }
}
