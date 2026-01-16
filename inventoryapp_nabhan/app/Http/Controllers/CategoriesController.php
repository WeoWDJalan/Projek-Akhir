<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Categories;


class CategoriesController extends Controller
{
    public function create(){
        return view('category.add');
    }
    
    public Function store(Request $request){
        // validation
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required',
        ]);

        $now = Carbon::now();

        //Insert Data
        DB::table('categories')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_at' => $now,
            'updated_at' => $now
        ]);

        //Redirect
        return redirect('/categories')->with('success', 'Category created successfully!');;
    }

    public function index(){
        $categories = DB::table('categories')->get();

        return view('category.show', ['categories' => $categories]);
    }

    public function show($id){
        $category =  Categories::find($id);
        return view('category.detail', ['category' => $category]);
    }

    public function edit($id){
        $category =  DB::table('categories')->find($id);
        return view('category.edit', ['category' => $category]);
    }

    public function update($id, Request $request){
        // validation
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required',
        ]);

        $now = Carbon::now();

        DB::table('categories')
            ->where('id', $id)
            ->update([
                        'name' => $request->input('name'),
                        'description' => $request->input('description'),
                        'updated_at' => $now
                    ]);

        //Redirect
        return redirect('/categories')->with('success', 'Category edited successfully!');;
    }

    public function destroy($id){
        DB::table('categories')->where('id', $id)->delete();
        return redirect('/categories')->with('success', 'Category delete successfully!');;
    }
}
