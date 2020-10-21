<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class BucketController extends Controller
{
//    This function should probably want to be reworked soon
//    And it might be better in an EntryController...
    public function inputEntries(Request $request) {
        if ($request->has('macs')) {
            $macs = $request->get('macs');
            foreach($macs as $mac) {
                $entry = new Entry();
                $entry->mac_address = $mac;
                $entry->bucket_id = 1;
                $entry->save();
            }
            return "Success";
        }
        else {
            return "Invalid Data";
        }
    }
}
