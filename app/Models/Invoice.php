<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Invoice extends Model
    {
        use HasFactory;

        protected $fillable = [
            'costumer_id',
            'amount',
            'status',
            'billed_data',
            'paid_data'
        ];

        public function costumer()
        {
            return $this->belongsTo(Costumer::class);
        }
    }
