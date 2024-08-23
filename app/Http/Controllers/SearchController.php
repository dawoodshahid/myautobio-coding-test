<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class SearchController extends Controller
{
    function index(Request $request) 
    {
        return view('welcome');
    }

    function search(Request $request) 
    {
        if ($request->filled('searchTerm')) 
        {
            $customers = Customer::with('orders.items');
            $search = $request->input('searchTerm');

            $customers = $customers->where(function ($query) use ($search) 
            {
                $query->where('email', 'like', "%{$search}%")
                    ->orWhereHas('orders', function ($query) use ($search) {
                        $query->where('order_number', 'like', "%{$search}%");
                    })

                    ->orWhereHas('orders.items', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            });

            $customers = $customers->get();

            if(count($customers) > 0)
            {
                return response()->json([
                    "status" => true,
                    "data" => $customers
                ]);
            }
            else
            {
                return response()->json([
                    "status" => false,
                    "data" => "No data found"
                ]);
            }
        }
        else
        {
            
        }
    }
}
