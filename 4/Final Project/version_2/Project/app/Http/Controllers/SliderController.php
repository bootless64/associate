<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function manageSliders()
    {
        $slides = Slider::orderBy('slide_number')->get();
        return view('dashboard.manage-sliders', compact('slides'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'slide_number' => 'required|integer|between:1,10|unique:sliders',
            'image' => 'required|image|max:500', // حداکثر 500 کیلوبایت
            'title' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:250',
            'button_text' => 'nullable|string|max:25',
            'button_link' => 'nullable|string|max:250',
        ]);

        $slide = new Slider();
        $slide->slide_number = $validated['slide_number'];
        $slide->title = $validated['title'];
        $slide->description = $validated['description'];
        $slide->button_text = $validated['button_text'];
        $slide->button_link = $validated['button_link'];

        $image = $validated['image'];
        $filename = $image->getClientOriginalName();
        if (Storage::exists('public/sliders/' . $filename)) {
            return back()->with('error', 'تصویری با همین نام قبلا در سیستم ذخیره شده است.')->withInput();
        }
        $image->storeAs('public/sliders/', $filename);
        $slide->image = $filename;
        $slide->save();
        return redirect()->route('dashboard.manage-sliders.index')->with('success', 'اسلاید با موفقیت ثبت شد.');
    }



    public function update(Request $request, Slider $slide)
    {
        $validated = $request->validate([
            'slide_number' => ['required', 'integer', 'between:1,10', Rule::unique('sliders')->ignore($slide->id)],
            'image' => ['sometimes', 'image', 'max:500'], // حداکثر 500 کیلوبایت
            'title' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:250'],
            'button_text' => ['nullable', 'string', 'max:25'],
            'button_link' => ['nullable', 'string', 'max:250'],
        ]);

        $slide->slide_number = $validated['slide_number'];
        $slide->title = $validated['title'];
        $slide->description = $validated['description'];
        $slide->button_text = $validated['button_text'];
        $slide->button_link = $validated['button_link'];

        if ($request->hasFile('image')) {
            $image = $validated['image'];
            $filename = $image->getClientOriginalName();
            if (Storage::exists('public/sliders/' . $filename)) {
                return back()->with('error', 'تصویری با همین نام قبلا در سیستم ذخیره شده است.')->withInput();
            }
            Storage::delete('public/sliders/' . $slide->image);
            $image->storeAs('public/sliders/', $filename);
            $slide->image = $filename;
        }
        $slide->save();
        return redirect()->route('dashboard.manage-sliders.index')->with('success', 'اسلاید با موفقیت ویرایش شد.');
    }



    public function destroy($id)
    {
        $slide = Slider::findOrFail($id);

        Storage::delete('public/sliders/' . $slide->image);

        $slide->delete();
        return back()->with('success', 'اسلاید حذف شد.');

    }
}
