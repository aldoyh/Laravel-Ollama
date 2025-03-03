<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toolbox;

class ToolboxController extends Controller
{
    public function index()
    {
        $presets = Toolbox::all();
        return view('prompt.toolbox', compact('presets'));
    }

    public function create()
    {
        return view('prompt.toolbox.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Toolbox::create($validatedData);

        return redirect()->route('toolbox.index')->with('success', 'Preset created successfully.');
    }

    public function edit(Toolbox $toolbox)
    {
        return view('prompt.toolbox.edit', compact('toolbox'));
    }

    public function update(Request $request, Toolbox $toolbox)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $toolbox->update($validatedData);

        return redirect()->route('toolbox.index')->with('success', 'Preset updated successfully.');
    }

    public function destroy(Toolbox $toolbox)
    {
        $toolbox->delete();

        return redirect()->route('toolbox.index')->with('success', 'Preset deleted successfully.');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $json = json_decode(file_get_contents($file), true);

        foreach ($json as $preset) {
            Toolbox::create($preset);
        }

        return redirect()->route('toolbox.index')->with('success', 'Presets imported successfully.');
    }

    public function export()
    {
        $presets = Toolbox::all()->toArray();
        $json = json_encode($presets);

        return response()->streamDownload(function () use ($json) {
            echo $json;
        }, 'presets.json');
    }
}