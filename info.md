#Erros
- 1 - Rota para o controller contract incorreta paramento {customer_id} duplicado;
- 2 - View, nome da sessão do layout incorreto ajustado de 'body' para 'content';
- 3 - Relacionamento entre Model\ContractItems\Item e  Model\Contract\Contract incorreto;
- 4 - CustomerRepository Assinatura da função incorreta, entrada duplicada;
- 5 - CustomerRepository Atributo do método de entrada com nome incorreto;
- 6 - CustomerRepository utilização de scopo na query de consulta/relacionamento do contract;
- 7 - Relacionamento entre Model\Customer\Customer e  Model\Contract\Contract incorreto;
- 8 - ContractController Faltou a referencia do repositorio Model\Customer\CustomerRepository
- 9 - ContractController Nome do método errado ajustado de index para show;
- 10 - ContractController assinatura incorreta, atributo de entrada duplicado;
- 11 - ContractController variavel current_date não existe no controller mas a mesma é utilizada na view;
- 12 - Relacionamento entre Model\Contract\Contract e  Model\Customer\Customer incorreto;

##Obs..:
      Alguns arquivos .php não foram finalizados com a ultima linha em branco, a PSR-1 recomenda a finalização de todo arquivo .php que contenha apenas codigos PHP com a finalidade de eliminar erros de processamentos em variações de servidores web 


###Arquivo: routes/web.php

De:
```
Route::get('/contract/{customer_id}/{contract_id}', [
```
Para: 
```
Route::get('/contract/{customer_id}', [
```
###Arquivo: resources/views/contract/show.blade.php

De:
```
@section('body')
```
Para: 
```
@section('content')
```
Obs...
```
    Foi adicionado uma linha em branco na ultima linha como recomendado pela PSR-1
```

###Arquivo: model/ContractItems/Item.php

De:
```
    public function contract()
    {
        return $this->belongsTo('Model\Contract\Contract', 'contract_id', 'contract_id');
    }
```
Para: 
```
    public $timestamps = false;

    public function contract()
    {
        return $this->hasOne('Model\Contract\Contract')->where('contract_id', $this->contract_id);
    }
```
Obs...
```
    Foi adicionado uma linha em branco na ultima linha como recomendado pela PSR-1
    Foi adicionado a propriedade public $timestamps = false;
```

###Arquivo: model/Customer/CustomerRepository.php

De:
```
    public function get($customer_id,$contract_id)
    {
        return $this->customer->with(['contract' => function ($query) use($contract_id) {
            $query->fields();
            $query->where('contract_id', $contract_id)->first();
        },'contract.items'])->find($customer_id);
    }
```
Para: 
```
    public function get($customer_id)
    {
        return $this->customer->with(['contract' => function ($query) use($customer_id) {
            $query->where('customer_id', $customer_id);
        },'contract.items'])->find($customer_id);
    }
```
Obs...
   ```
    Foi adicionado uma linha em branco na ultima linha como recomendado pela PSR-1
   ```

###Arquivo: model/Customer/Customer.php

De:
```
return $this->hasOne('Model\Contract\ContractItem', 'customer_id', 'customer_id');
```
Para:
```
return $this->hasOne('Model\Contract\Contract', 'customer_id', 'customer_id');
```
Obs...
```
    Foi adicionado uma linha em branco na ultima linha como recomendado pela PSR-1
```

###Arquivo: app/Http/Controllers/ContractController.php
De:
```
class ContractController extends Controller
{
    public function index($contract_id,$customer_id, CustomerRepository $customerRepository)
    {
        $customer = $customerRepository->get($customer_id,$contract_id);
        return view('contract.show', compact('customer'));
    }
}
```
Para:
```
use Model\Customer\CustomerRepository;

class ContractController extends Controller
{
    public function show($customer_id, CustomerRepository $customerRepository)
    {
        $customer = $customerRepository->get($customer_id);

        $current_date = now()->format('d/m/Y');

        return view('contract.show', compact('customer', 'current_date'));
    }
}
```

###Arquivo: model/Contract/Contract.php

De:
```
     public function customer()
    {
        return $this->belongsTo('Model\Customer\Customer', 'customer_id', 'customer_id');
    }
```
Para:
```
    public $incrementing = false;

    public function customer()
    {
        return $this->belongsTo('Model\Customer\Customer')->where('customer_id', $this->customer_id);
    }
```
Obs...
```
    Foi adicionado uma linha em branco na ultima linha como recomendado pela PSR-1
```
