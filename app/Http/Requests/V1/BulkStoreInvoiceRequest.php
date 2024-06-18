<?php

    namespace App\Http\Requests\V1;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class BulkStoreInvoiceRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            $user = $this->user();

            return $user !== null && $user->tokenCan('create');
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array
        {
            return [
                '*.costumer_id' => ['required', 'integer'],
                '*.amount' => ['required', 'numeric'],
                '*.status' => ['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
                '*.billed_data' => ['required', 'date_format:Y-m-d H:i:s'],
                '*.paid_data' => ['date_format:Y-m-d H:i:s', 'nullable']
            ];
        }

        /*protected function prepareForValidation()
        {

            $invoices = $this->toArray();
            $data = array_map(function ($item) {
                return [
                    'costumer_id' => $item['costumerId'],
                    'amount' => $item['amount'],
                    'status' => $item['status'],
                    'billed_data' => $item['billedData'],
                    'paid_data' => $item['paidData']
                ];
            }, $this->toArray());
            $transformedInvoices = array_map([$this, 'transformKeys'], $invoices); // Use [$this, 'transformKeys']
            //dd($transformedInvoices);
            $invoices = $this->all();
            $transformedInvoices = array_map([$this, 'transformKeys'], $invoices);
            dd($transformedInvoices);
            //$this->replace($transformedInvoices);
            //$this->replace($data);
            //dd($data);
            //Now I got this error: {
            //    "message": "The 0.costumerId field is required. (and 19 more errors)",
            //    "errors": {
            //        "0.costumerId": [
            //            "The 0.costumerId field is required."
            //        ],
            //        "1.costumerId": [
            //            "The 1.costumerId field is required."
            //        ],
            //        "2.costumerId": [
            //            "The 2.costumerId field is required."
            //        ],
            //        "3.costumerId": [
            //            "The 3.costumerId field is required."
            //        ],
            //        "4.costumerId": [
            //            "The 4.costumerId field is required."
            //        ],
            //        "5.costumerId": [
            //            "The 5.costumerId field is required."
            //        ],
            //        "6.costumerId": [
            //            "The 6.costumerId field is required."
            //        ],
            //        "7.costumerId": [
            //            "The 7.costumerId field is required."
            //        ],
            //        "8.costumerId": [
            //            "The 8.costumerId field is required."
            //        ],
            //        "9.costumerId": [
            //            "The 9.costumerId field is required."
            //        ],
            //        "0.billedData": [
            //            "The 0.billedData field is required."
            //        ],
            //        "1.billedData": [
            //            "The 1.billedData field is required."
            //        ],
            //        "2.billedData": [
            //            "The 2.billedData field is required."
            //        ],
            //        "3.billedData": [
            //            "The 3.billedData field is required."
            //        ],
            //        "4.billedData": [
            //            "The 4.billedData field is required."
            //        ],
            //        "5.billedData": [
            //            "The 5.billedData field is required."
            //        ],
            //        "6.billedData": [
            //            "The 6.billedData field is required."
            //        ],
            //        "7.billedData": [
            //            "The 7.billedData field is required."
            //        ],
            //        "8.billedData": [
            //            "The 8.billedData field is required."
            //        ],
            //        "9.billedData": [
            //            "The 9.billedData field is required."
            //        ]
            //    }
            //}
        }

        // Function to transform keys of an array

        private function transformKeys($array)
        {
            $newArray = [];
            foreach ($array as $key => $value) {
                $newKey = $this->camelToSnake($key); // Use $this->camelToSnake()
                $newArray[$newKey] = $value;
            }
            return $newArray;
        }

        private function camelToSnake($str)
        {
            return strtolower(preg_replace_callback('/[A-Z]/', function ($match) {
                return '_' . strtolower($match[0]);
            }, $str));
        }*/
    }
