<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use Illuminate\Http\Request;
use App\Http\Resources\NeighborhoodResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pic;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.neighborhoods.index', ['neighborhoods' => Neighborhood::paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.neighborhoods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $neighborhood = Neighborhood::create($request->except(['_token', 'pics']));

        if($request->has('pics'))
        {
            foreach($request->pics as $pic)
            {
                //$newFileName = time().'-'.$pic->getClientOriginalName().'.'.$pic->guessExtension;
                $name = $pic->getClientOriginalName();
                $extension = $pic->getClientOriginalExtension();

                // $pic->move(public_path('images/neighborhoods/'.$neighborhood->id, $newFileName));
                $path = Storage::putFileAs(
                    'neighborhoods/'.$neighborhood->id, $pic, $name, 'public'
                );

                $picModel = new Pic([
                    'company_id' => Auth::user()->company_id,
                    'filename' => 'storage/'.$path,
                    'order' => 0,
                    'alt' => '',
                    'title' => '',
                ]);
                $neighborhood->pics()->save($picModel);
            }
        }

        return redirect()->route('admin.neighborhoods.show', $neighborhood->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return redirect()->route('admin.neighborhoods.edit', $slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $neighborhood = Neighborhood::where('slug', $slug)->firstOrFail();

        return view('admin.neighborhoods.edit', ['neighborhood' => $neighborhood]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $neighborhood = Neighborhood::where('slug', $slug)->firstOrFail();

        $neighborhood->update($request->except(['_token', '_method', 'pics']));

        if($request->has('pics'))
        {
            foreach($request->pics as $pic)
            {
                //$newFileName = time().'-'.$pic->getClientOriginalName().'.'.$pic->guessExtension;
                $name = $pic->getClientOriginalName();
                $extension = $pic->getClientOriginalExtension();

                // $pic->move(public_path('images/neighborhoods/'.$neighborhood->id, $newFileName));
                $path = Storage::putFileAs(
                    'neighborhoods/'.$neighborhood->id, $pic, $name, 'public'
                );

                $picModel = new Pic([
                    'company_id' => Auth::user()->company_id,
                    'filename' => 'storage/'.$path,
                    'order' => 0,
                    'alt' => '',
                    'title' => '',
                ]);
                $neighborhood->pics()->save($picModel);
            }
        }

        return redirect()->route('admin.neighborhoods.show', $neighborhood->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Neighborhood::where('slug', $slug)->delete();

        return redirect()->route('admin.neighborhoods.index');
    }
}
