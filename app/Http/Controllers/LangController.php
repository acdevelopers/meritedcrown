<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class LangController
 *
 * @package App\Http\Controllers
 * @author Anitche Chisom
 */
class LangController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate(['lang' => 'required|string|max:2|min:2']);

        if (app()->getLocale() == $validated['lang'])
        {
            flash("Your currently using the selected language.")->important();

            return back();
        }

        // Store the user's preferred language in the session.
        session(['lang' => $validated['lang']]);

        app()->setLocale($validated['lang']);

        flash()->success("Language changed!");

        return back();
    }
}
