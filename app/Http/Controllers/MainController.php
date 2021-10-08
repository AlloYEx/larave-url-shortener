<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Url;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function shortUrl(Request $r)
    {
        if(!$r->link) {
            return back()->with('error', 'Provide the URL!');
        }

        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $r->link)) { 
          return back()->with('error', 'URL invalid format!');
        }

        $randomString = $this->generateRandomString();

        $existUrl = Url::where('shorted_url', $randomString)->exists();

        while($existUrl) {
            $randomString = $this->generateRandomString();
        }

        $link = Url::create([
            'original_url' => $r->link,
            'shorted_url' => $randomString
        ]);

        return redirect()->route('index')->with(['success' => 'New URL generated!', 'link' => $link->shorted_url]);
    }

    public function next($url)
    {
        $link = Url::where('shorted_url', $url)->firstOrFail();

        if($link) {
            $link->increment('visits');

            return redirect()->to($link->original_url);
        } else {
            return redirect()->route('index')->with('error', 'We have no URL with this name!');
        }

    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
