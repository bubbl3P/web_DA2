<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;


class CourseController extends Controller
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

        return view('admin.index');
    }

    public function api()
    {
        return DataTables::of(Course::query())
            ->addColumn('edit', function ($object) {
                    return route('courses.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('courses.destroy', $object);
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(StoreRequest $request)
    {
//         $object = new Course();
//         $object->save();

        Course::create($request->validated());

        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        return view('admin.edit', [
            'each' => $course,
        ]);
    }

    public function update(Request $request, Course $course)
    {
         Course::query()->where('id', $course->id)->update(
             $request->except([
                 '_token',
                 '_method',
             ])
         );
        $course->update(
             $request->except([
                 '_token',
                 '_method',
             ])
         );
//
//        $course->fill($request->validated());
//        $course->save();

        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        Course::destroy($course);
        Course::query()->where('id', $course->id)->delete();
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
