<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BucketController extends Controller
{
//    This function should probably want to be reworked soon
//    And it might be better in an EntryController...
    public function inputEntries(Request $request) {
        if ($request->has('macs')) {
            $macs = $request->get('macs');
            foreach($macs as $mac) {
                $old_entry = \App\Models\Entry::where('mac_address', $mac)->orderBy('updated_at', 'desc')->get()->first();
                if ($old_entry != null) {
                    $diff = \Carbon\Carbon::parse($old_entry->updated_at)->diffInMinutes(\Carbon\Carbon::now());
                    if($diff <= env('ENTRY_SPLIT_DURATION', 15)) {
                        $old_entry->updated_at = Carbon::now();
                        $old_entry->save();
                    }
                    else {
                        $this->createEntry($mac);
                    }
                }
                else {
                    $this->createEntry($mac);
                }
            }
            return "Success";
        }
        else {
            return "Invalid Data";
        }
    }

    function createEntry($mac, $bucket=1) {
        $entry = new Entry();
        $entry->mac_address = $mac;
        $entry->bucket_id = $bucket;
        $entry->save();
    }
}
