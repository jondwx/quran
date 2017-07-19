<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sura;
use App\Aya;
use stdClass;

class Nav {
    public function __construct($ayas) {
        $this->ayas = $ayas;
        $this->_();
    }

    private function _() {
        $ayas = $this->ayas;
        $aya = $ayas->first();
        $sura = $aya->sura;
        $sura_ayas_count = $sura->ayas->count();
        $ayas_count = count($ayas);
        if ($sura_ayas_count === $ayas_count) {
            $view_sura = true;
        }
        $prev = new stdClass;
        $next = new stdClass;
        if (@$view_sura) {
            $sura_prev = Sura::find(
                ($sura->id - 1 === 0) ? 114 : $sura->id - 1
            );
            $prev->url = url('/' . $sura_prev->id);
            $prev->label = $sura_prev->title;
            $sura_next = Sura::find(($sura->id + 1 > 114) ? 1 : $sura->id + 1);
            $next->url = url('/' . $sura_next->id);
            $next->label = $sura_next->title;
        } else {
            $aya_prev = Aya::find(
                ($ayas->first()->id - 1 === 0) ?
                Aya::count() : $ayas->first()->id - 1
            );
            $prev->url = url('/' . $aya_prev->sura->id . '/' . $aya_prev->id);
            $prev->label = $aya_prev->sura->title . ' ~ ' . $aya_prev->aya_id;
            $aya_next = Aya::find(
                ($ayas->last()->id + 1) > Aya::count() ?
                1 : $ayas->last()->id + 1
            );
            $next->url = url('/' . $aya_next->sura->id . '/' . $aya_next->id);
            $next->label = $aya_next->sura->title . ' ~ ' . $aya_next->aya_id;
        }
        $this->prev = $prev;
        $this->next = $next;
    }
}

class QuranController extends Controller
{
    public function index(Sura $sura, $aya_start = false, $aya_end = false) {
        if (!$aya_end and !$aya_start) {
            $aya_start = 1;
            $aya_end = $sura->ayas->count();
        }
        if ($aya_end) {
            $ayas = $sura->ayas()->where([
                ['aya_id', '>=', $aya_start],
                ['aya_id', '<=', $aya_end],
            ])->get();
        } else {
            $ayas = $sura->ayas()->where([
                ['aya_id', '=', $aya_start],
            ])->get();
        }
        $suras = Sura::all();
        $nav = new Nav($ayas);
        return view('quran.index', [
            'suras' => $suras,
            'ayas'  => $ayas,
            'nav'   => $nav,
        ]);
    }
}
