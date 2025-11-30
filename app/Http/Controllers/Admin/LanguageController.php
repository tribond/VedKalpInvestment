<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Language;

class LanguageController extends Controller
{
    public function list(Request $request)
    {
        $query = Language::query();

        // Apply filters
        $language_name = $request->input('language_name');
        if ($request->filled('language_name')) {
            $query->where('language_name', $request->input('language_name'));
        }

        // Paginate results
        $languageData = $query->paginate(4);

        return view('admin.language.list', compact('languageData','language_name'));
    }

    public function addLanguage()
    {
        return view('admin.language.add');
    }

    public function saveLanguage(Request $request)
    {
        //echo '<pre>'; print_r($request->all()); exit;
        if($request->isMethod('post')){
            $language = new Language();
            $language->language_code = $request['language_code'];
            $language->language_name = $request['language_name'];
            $language->created_at = date('Y-m-d');
            $language->save();
            return Redirect::to("admin/language/list")->withSuccess('Language added sucessfully.');
        }
    }

    public function edit($id)
    {
        $editId = base64_decode($id);
        $languageData = Language::where(['language_id'=>$editId])->first();
        //echo '<pre>'; print_r($languageData); exit;
        return view('admin.language.edit',compact('languageData'));
    }

    public function update(Request $request)
    {
        $editedData = [];
        if($request->isMethod('post'))
        {   
            $language_id = $request['language_id'];
            $language = Language::findOrFail($language_id);
            $language->language_name = $request['language_name'];
            $language->language_code = $request['language_code'];
            $language->updated_at = now();
            $language->save();
            return Redirect::to("admin/language/list")->withSuccess('Language updated sucessfully.');
        }
    }

    public function delete($id)
    {
        $deletedId = base64_decode($id); 
        Language::where('language_id', $deletedId)->delete();
        return Redirect::to("admin/language/list")->withFail('Language deleted sucessfully.');        
    }
}