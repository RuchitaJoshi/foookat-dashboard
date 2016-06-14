<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all categories
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $categories = Category::withTrashed()->latest()->paginate(10);

        return view('categories.all', ['categories' => $categories]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        return view('categories.show', ['category' => $category]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create(['name' => $request->get('name'),
            'commission' => $request->get('commission'),
            'order' => $request->get('order'),
            'active' => 1
        ]);

        Flash::success($category->name . ' has been successfully created.');

        return redirect(route('categories.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        return view('categories.edit', ['category' => $category]);
    }

    /**
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, CategoryRequest $request)
    {
        $category = Category::withTrashed()->findOrFail($id);

        $category->update(['name' => $request->get('name'),
            'commission' => $request->get('commission'),
            'order' => $request->get('order'),
            'active' => $request->get('active') == "on" ? 1 : 0
        ]);

        Flash::success($category->name . ' has been successfully updated.');

        return redirect(route('categories.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $category = Category::withTrashed()->findOrFail($id);

                $category->delete();

                Flash::success('Category has been successfully deleted.');

                return redirect(route('categories.show', $category->id));
            } else {
                return Response::view('errors.403');
            }
        }
    }
}
