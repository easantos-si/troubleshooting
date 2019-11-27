<?php namespace Model\ContractItems;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    protected $table = 'contract_items';
    protected $primaryKey = 'contract_item_id';
    public $timestamps = false;

    public function contract()
    {
        return $this->hasOne('Model\Contract\Contract')->where('contract_id', $this->contract_id);
    }
}
