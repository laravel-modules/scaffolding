<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laraeast\LaravelSettings\Facades\Settings;

class MediaController extends Controller
{
    /**
     * Upload the image from editor.
     *
     * @return string
     */
    public function editorUpload(Request $request)
    {
        $request->validate(['image' => 'required|image']);

        Settings::set('editor')->addMedia($request->file('image'))->toMediaCollection('editor');

        $media = Settings::instance('editor')->media()->latest()->first();

        return url($media->getUrl());
    }
}
