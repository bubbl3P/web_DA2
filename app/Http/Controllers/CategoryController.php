<?php

namespace App\Http\Controllers;


use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class CategoryController extends Controller
{


    private Builder $model;
//    public function __construct()
//    {
//        $this->model = (new Course())->query();
//        $routeName   = Route::currentRouteName();
//        $arr         = explode('.', $routeName);
//        $arr         = array_map('ucfirst', $arr);
//        $title       = implode(' - ', $arr);
//
//        View::share('title', $title);
//    }
    public function index()
    {

        return view('admin.index-category');
    }

    public function api()
    {
        return DataTables::of(Category::query())
            ->addColumn('edit', function ($object) {
                return route('category.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('category.destroy', $object);
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreRequest $request)
    {
//         $object = new Course();
//         $object->save();

        Category::create($request->validated());

        return redirect()->route('category.index');
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'each' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        Category::query()->where('id', $category->id)->update(
            $request->except([
                '_token',
                '_method',
            ])
        );
        $category->update(
            $request->except([
                '_token',
                '_method',
            ])
        );
//
//        $course->fill($request->validated());
//        $course->save();

        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        Category::destroy($category);
        Category::query()->where('id', $category->id)->delete();
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';
        return response($arr, 200);
    }
    public function apiName(Request $request){
        return $this->model
            ->where('name', 'like','%'.$request->get('t').'%')
            ->get([
                'name',
            ]);
    }



}

