<?php

namespace App\Http\Controllers\Settings\Gateway;

use Illuminate\Http\Request;
use App\Services\StripeBanks;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StripeBanks $stripeBanks)
    {
        $banks = $stripeBanks->list();

        return view('admin.settings.gateway.banks.index')
            ->withBanks($banks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.gateway.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StripeBanks $stripeBanks)
    {
        $bank = $stripeBanks->create($request);

        return redirect()->route('admin.settings.gateway.banks.show', $bank->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, StripeBanks $stripeBanks)
    {
        $bank = $stripeBanks->retrieve($id);

        return view('admin.settings.gateway.banks.show')
            ->withBank($bank);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, StripeBanks $stripeBanks)
    {
        $bank = $stripeBanks->retrieve($id);

        return view('admin.settings.gateway.banks.edit')
            ->withBank($bank);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, StripeBanks $stripeBanks)
    {
        $bank = $stripeBanks->update($request);

        return redirect()->route('admin.settings.gateway.banks.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, StripeBanks $stripeBanks)
    {
        $stripeBanks->delete($id);

        return redirect()->route('admin.settings.gateway.banks.index');
    }
}
