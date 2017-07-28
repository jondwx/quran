<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\IP;

class LogController extends Controller
{
    public function index() {
        $logs_grouped = Log::orderBy('created_at', 'desc')->get()
            ->groupBy('ip');
        $data_ips = IP::all();
        $ips = [];
        foreach ($logs_grouped as $ip => $logs) {
            $data_ip = $data_ips->where('ip', $ip)->first();
            if (!$data_ip) {
                $data_ip = IP::create(ip_details($ip));
            }
            $ips[$ip] = $data_ip->toArray();
        }
        return view('log.index', [
            'ips' => $ips,
            'logs_grouped' => $logs_grouped,
        ]);
    }
}
