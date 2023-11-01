<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class LocalizationController extends Controller
{
    public function adminIndex(): View
    {
        $languages = Language::all();
        return view('admin.localization.admin-index', compact('languages'));
    }

    public function frontendIndex(): View
    {
        $languages = Language::all();
        return view('admin.localization.frontend-index', compact('languages'));
    }

    public function extractLocalizationStrings(Request $request)
    {
        $directory = $request->directory;
        $languageCode = $request->language_code;
        $fileName = $request->file_name;

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        $localizationStrings = [];

        // Iterate over each file in the directory
        foreach ($files as $file) {
            if ($file->isDir()) {
                continue;
            }

            $contents = file_get_contents($file->getPathname());

            preg_match_all('/__\([\'"](.+?)[\'"]\)/', $contents, $matches);

            if (!empty($matches[1])) {
                foreach ($matches[1] as $match) {
                    $localizationStrings[$match] = $match;
                }
            }
        }

        $phpArray = "<?php\n\nreturn " . var_export($localizationStrings, true) . ";\n";

        // create language sub folder if it is not exit
        if (!File::isDirectory(lang_path($languageCode))) {
            File::makeDirectory(lang_path($languageCode), 0755, true);
        }

        // dd(lang_path($languageCode . '/' . $fileName . '.php'));
        file_put_contents(lang_path($languageCode . '/' . $fileName . '.php'), $phpArray);
    }

    public function updateLangString(Request $request): RedirectResponse
    {
        $languageStrings = trans($request->file_name, [], $request->lang_code);

        $languageStrings[$request->key] = $request->value;

        $phpArray = "<?php\n\nreturn " . var_export($languageStrings, true) . ";\n";
        file_put_contents(lang_path($request->lang_code . '/' . $request->file_name . '.php'), $phpArray);

        toast(__('Updated Successfully!'), 'success');

        return redirect()->back();
    }

    public function translateString(Request $request)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://microsoft-translator-text.p.rapidapi.com/translate?to%5B0%5D=de&api-version=3.0&profanityAction=NoAction&textType=plain', [
            'body' => '[
            {
                "Text": "I would really like to drive your car around the block a few times."
            }
        ]',
            'headers' => [
                'X-RapidAPI-Host' => 'microsoft-translator-text.p.rapidapi.com',
                'X-RapidAPI-Key' => 'dbd8d4e7c5msh4f0615717a94277p169889jsndbfd909766cc',
                'content-type' => 'application/json',
            ],
        ]);

        echo $response->getBody();
    }
}
