<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
//use App\Http\Requests\UpdateCostumerRequest;
use App\Http\Resources\V1\CostumerResource;
use App\Http\Resources\V1\CostumerCollection;
use App\Models\Costumer;
use App\Filters\V1\CostumerFilter;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreCostumerRequest;
use App\Http\Requests\V1\UpdateCostumerRequest;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CostumerFilter();
        $queryItems = $filter->transform($request); // ['column', 'operator', 'value']

        $includeInvoices = $request->query('includeInvoices');

        /*if(count($queryItems) === 0) {
            return new CostumerCollection(Costumer::paginate());
        }*/

        $costumers = Costumer::where($queryItems);

        if($includeInvoices) {
            $costumers = $costumers->with('invoices');
        }

        return new CostumerCollection($costumers->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCostumerRequest $request)
    {
        $costumer = Costumer::create($request->all());
        return new CostumerResource($costumer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Costumer $costumer)
    {
        $includeInvoices = request()->query('includeInvoices');

        if($includeInvoices) {
            return new CostumerResource($costumer->loadMissing('invoices'));
        }

        return new CostumerResource($costumer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Costumer $costumer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCostumerRequest $request, Costumer $costumer)
    {
        $costumer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Costumer $costumer)
    {
        //
    }
}
