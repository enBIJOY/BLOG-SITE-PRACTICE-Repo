<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;

class GeneralSettingController extends Controller
{
    // public function index()
    // {
    //     return view('dashboard.generalSettings', [

    //         'generalSettings' => GeneralSetting::first()
    //     ]);
    // }
    
    // PAGE LOAD
    public function index()
    {
        $generalSettings = GeneralSetting::first();
        // dd($generalSettings);
        return view('dashboard.generalSettings', compact('generalSettings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */

    // UPDATE SETTINGS
    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'nullable|string|max:15',
            'phone2' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'address2' => 'nullable|string',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'year' => 'nullable|string|max:4',
        ]);

        $settings = GeneralSetting::findOrFail($id);

        $data = $request->except(['logo', 'favicon']);

        if ($request->hasFile('logo')) {
            $logo = uniqid().'_logo.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/general'), $logo);
            $data['logo'] = $logo;
        }

        if ($request->hasFile('favicon')) {
            $icon = uniqid().'_favicon.'.$request->favicon->extension();
            $request->favicon->move(public_path('uploads/general'), $icon);
            $data['favicon'] = $icon;
        }

        $settings->update($data);

        return back()->with('success', 'Messege show from component');
    }

    public function destroy(GeneralSetting $generalSetting)
    {
        //
    }
}
