<?php

namespace App;

use App\Notifications\OrderStatusUpdated;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'line_items',
        'payment_method',
        'subtotal',
        'total',
        'status'
    ];

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function setLineItemsAttribute($value)
    {
        $this->attributes['line_items'] = json_encode($value);
    }

    function getStatusAttribute($value)
    {
        switch ($value) {
            case 'closed_fullfilled':
                return 'Closed';
                break;
            case 'closed_unfullfilled':
                return 'Cancelled';
                break;
            default:
                return $value;
                break;
        }
    }

    function getPaymentMethodAttribute($value)
    {
        switch ($value) {
            case 'pickup-cash':
                return 'Cash upon Pick-up';
                break;
            case 'delivery':
                return 'Cash upon Delivery';
                break;
            case 'bank-transfer':
                return 'Bank Transfer';
                break;
            default:
                return 'N/A';
                break;
        }
    }

    function getLineItemsAttribute($value)
    {
        return (array) json_decode($value);
    }

    function updateStatus($new_status)
    {
        switch ($new_status) {
            case 'new':
                // first change the status
                $this->update(['status' => 'new']);

                $this->user->notify(new OrderStatusUpdated($this));
                break;

            case 'processing':
                // first change the status
                $this->update(['status' => 'processing']);

                $this->user->notify(new OrderStatusUpdated($this));
                break;
            case 'ready':
                // first change the status
                $this->update(['status' => 'ready']);

                $this->user->notify(new OrderStatusUpdated($this));
                break;
            case 'closed_fullfilled':
                // first change the status
                $this->update(['status' => 'closed_fullfilled']);

                $this->user->notify(new OrderStatusUpdated($this));
                break;
            case 'closed_unfullfilled':
                // first change the status
                $this->update(['status' => 'closed_unfullfilled']);

                $this->user->notify(new OrderStatusUpdated($this));
                break;

            default:
                # code...
                break;
        }
    }
}
