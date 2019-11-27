<?php namespace Model\Contract;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model {

    protected $table = 'contract';
    protected $primaryKey = 'contract_id';
    public $timestamps = false;
    public $incrementing = false;

    public function customer()
    {
        return $this->belongsTo('Model\Customer\Customer')->where('customer_id', $this->customer_id);
    }

    public function items()
    {
        return $this->hasMany('Model\ContractItems\Item', 'contract_id', 'contract_id');
    }

    public function scopeFields($query)
    {
        return $query->select('customer_id','description');
    }
}
