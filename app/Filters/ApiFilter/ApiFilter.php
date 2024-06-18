<?php

    namespace App\Filters\ApiFilter;

    use Illuminate\Http\Request;

    class  ApiFilter {
        protected $safeParts = [];

        protected $columnMap = [];

        protected $operatorMap = [];

        public function transform(Request $request) {
            $eloquentQuery = [];

            foreach ($this->safeParts as $part => $operators) {
                $query = $request->query($part);
                if(!isset($query)) {
                    continue;
                }

                $column = $this->columnMap[$part] ?? $part;
                foreach ($operators as $operator) {
                    if (isset($query[$operator])) {
                        $eloquentQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                    }
                }
            }

            return $eloquentQuery;
        }
    }
