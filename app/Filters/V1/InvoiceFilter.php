<?php

    namespace App\Filters\V1;

    use Illuminate\Http\Request;
    use App\Filters\ApiFilter\ApiFilter;

    class InvoiceFilter extends ApiFilter {
        protected $safeParts = [
            'costumerId' => ['eq'],
            'amount' => ['eq', 'lt', 'gt', 'lte', 'gte'],
            'status' => ['eq', 'ne'],
            'billedData' => ['eq', 'lt', 'gt', 'lte', 'gte'],
            'paidData' => ['eq', 'lt', 'gt', 'lte', 'gte']
        ];

        protected $columnMap = [
            'costumerId' => 'costumer_id',
            'billedData' => 'billed_data',
            'paidData' => 'paid_data'
        ];

        protected $operatorMap = [
            'eq' => '=',
            'lt' => '<',
            'lte' => '≤',
            'gt' => '>',
            'gte' => '≥',
            'ne' => '<>'
        ];
    }
