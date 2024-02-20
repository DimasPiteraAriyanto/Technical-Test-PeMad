<?php

namespace App\Http\Controllers;

use App\Models\PayOrder;
use App\Repositories\OrderRepository;
use App\Repositories\PurchaseOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PayOrderController extends Controller
{

    protected $orderRepository, $purchaseOrderRepository;

    public function __construct(OrderRepository $orderRepository, PurchaseOrderRepository $purchaseOrderRepository)
    {
        $this->purchaseOrderRepository = $purchaseOrderRepository;
        $this->orderRepository = $orderRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = $this->orderRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_order.*' => 'required|string|max:255', // Validate each name_order field as a string
            'date_order' => 'required|date',
            'detail_order' => 'required|string',
            'total_order' => 'required|integer',
            'status_order' => 'required|in:0,1',
        ]);

        // Extract name_order values from the validated data
        $nameOrders = $validatedData['name_order'];

        // Extract the first name_order value if available
        $first_name_order = !empty($validatedData['name_order']) ? $validatedData['name_order'][0] : null;

// Create a new order using the repository
        $orderData = [
            'name_order' => $first_name_order,
            'date_order' => $validatedData['date_order'],
            'detail_order' => $validatedData['detail_order'],
            'total_order' => $validatedData['total_order'],
            'status_order' => $validatedData['status_order'],
        ];


//        dd($request->all());

        $order = $this->orderRepository->createOrderWithPurchaseOrders($orderData, $nameOrders);


        return Redirect::route('orders.index')->with('success', 'New Order has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayOrder $order)
    {
        return view('orders.edit', [
            'order' => $order
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PayOrder $order)
    {
        $rules = [
            'name_order' => 'required|string|max:255',
            'date_order' => 'required|date',
            'detail_order' => 'required|string',
            'total_order' => 'required|integer',
            'status_order' => 'required|in:0,1',
        ];
        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->orderRepository->update($validatedData, $order);

        return Redirect::route('orders.index')->with('success', 'Order has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayOrder $order)
    {
        // Delete client using the repository
        $this->orderRepository->delete($order);

        return Redirect::route('orders.index')->with('success', 'Order has been deleted!');
    }
}
