<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use DataTables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Productsdata = Products::latest()->get();

            return Datatables::of($Productsdata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




        // $addProducts = new Products();

        // $addProducts->image = request('image');
        // $addProducts->title = request('title');
        // $addProducts->price = request('price');
        // $addProducts->description = request('des');
        // $addProducts->type = request('type');
        // $addProducts->discount = request('discount');

        // $addProducts->save();

        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'des' => 'required',
        ]);


        $title = $request->input('title');
        $price = $request->input('price');
        $des = $request->input('des');
        $discount = $request->input('discount');
        $type = $request->input('type');

        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $path = $request->image->getClientOriginalName();
            $extenstion = $file->getClientOriginalExtension();
            $image = time() . '.' . $extenstion;
            $file->move(public_path() . ('/photo'), $image);
        }

        Products::create([

            'title' => $title,
            'price' => $price,
            'description' => $des,
            'discount' => $discount,
            'type' => $type,
            'image' => $image

        ]);

        return redirect('/products')->with('msg', __('Insert Success !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {


        //https://laravel.com/docs/5.8/queries#updates
        //https://laravel.com/docs/5.8/eloquent#inserting-and-updating-models

        $id = $request->input('id');
        $title = $request->input('title');
        $price = $request->input('price');
        $des = $request->input('des');
        $discount = $request->input('discount');
        $type = $request->input('type');


        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $path = $request->image->getClientOriginalName();
            $extenstion = $file->getClientOriginalExtension();
            $image = time() . '.' . $extenstion;
            $file->move(public_path() . ('/photo'), $image);
        }

        Products::where('id', $id)
            ->update([
                'title' => $title,
                'price' => $price,
                'description' => $des,
                'discount' => $discount,
                'type' => $type,
                'image' => $image
            ]);

        return redirect('/products')->with('messages', __('Flashdata.insert'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}
