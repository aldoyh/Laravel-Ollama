@extends('prompt')

@section('content')
<div class="toolbox">
    <h2>Prompt Presets Toolbox</h2>
    <div class="toolbox-search">
        <input type="text" placeholder="Search presets...">
    </div>
    <div class="toolbox-categories">
        <h3>Categories</h3>
        <ul>
            <li>Category 1</li>
            <li>Category 2</li>
            <li>Category 3</li>
        </ul>
    </div>
    <div class="toolbox-presets">
        <h3>Presets</h3>
        <ul>
            <li>Preset 1</li>
            <li>Preset 2</li>
            <li>Preset 3</li>
        </ul>
    </div>
    <div class="toolbox-actions">
        <button>Create Preset</button>
        <button>Edit Preset</button>
        <button>Delete Preset</button>
        <button>Import Preset</button>
        <button>Export Preset</button>
    </div>
</div>
@endsection