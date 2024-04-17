<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::paginate(3);
        return view('admin.index', ['products' => $products]);
    }

    public function view_add()
    {
        return view('admin.addProduct');
    }

    public function create_product(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image',
            'cost' => 'required|numeric',
        ], [
            'title.required' => 'Заполните поле!',
            'description.required' => 'Заполните поле!',
            'photo.required' => 'Заполните поле!',
            'photo.image' => 'Только фото!',
            'cost.required' => 'Заполните поле!',
            'cost.numeric' => 'Числовое значение!',
        ]);

        $hashPhoto = $request->file('photo')->hashName();
        $store = $request->file('photo')->store('public/product');

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $hashPhoto,
            'cost' => $request->cost,
        ]);

        if ($product) {
            return redirect()->back()->with('success', 'Товар добавлен!');
        } else {
            return redirect()->back();
        }
    }

    public function view_edit($edit)
    {
        $edit_data = Product::find($edit);
        return view('admin.editProduct', ['edit' => $edit_data]);
    }

    public function update_product(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'image',
            'cost' => 'required|numeric',
        ], [
            'title.required' => 'Заполните поле!',
            'description.required' => 'Заполните поле!',
            'photo.image' => 'Только фото!',
            'cost.required' => 'Заполните поле!',
            'cost.numeric' => 'Числовое значение!',
        ]);

        if (!empty($request->file('photo'))) {
            $hashPhoto = $request->file('photo')->hashName();
            $store = $request->file('photo')->store('public/product');
        } else {
            $hashPhoto = $product->photo;
        }

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $hashPhoto,
            'cost' => $request->cost,
        ]);

        return redirect('/admin')->with('success', 'Запись обновлена!');
    }

    public function delete(Product $delete)
    {
        $delete->delete();

        return redirect()->back()->with('success', 'Запись удалена!');
    }
}
