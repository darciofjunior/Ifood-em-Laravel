<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;

        $this->middleware(['can:plans']);
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }

    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show', [
            'plan' => $plan 
        ]);
    }

    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', [
            'plan' => $plan 
        ]);
    }

    public function update(StoreUpdatePlan $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }

    public function destroy($url)
    {
        $plan = $this->repository
                ->with('details')
                ->where('url', $url)
                ->first();

        if($plan->details->count() > 0) {
            return redirect()
                    ->back()
                    ->with('error', 'Existem detalhes vinculados a esse plano, portanto não pode deletar');
        }

        if(!$plan)
            return redirect()->back();

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters
        ]);
    }
}
