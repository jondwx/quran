@extends('layout.quran')

@section('ayas')
    @foreach ($ayas as $aya)
        <?php
            $ars[] = view('quran.aya', ['aya' => $aya])->render();
            $ids[] = view('quran.aya-id', ['aya' => $aya])->render();
        ?>
    @endforeach
    <div class="view">
        <div
            class="aya-ar"
            dir="rtl"
            lang="ar"
        >
            {!! implode('', $ars) !!}
        </div>
        <hr style="border-color: rgba(0, 0, 0, .2);">
        <i style="font-weight: 200;">
            {!! implode(' &bull; ', $ids) !!}
            <span style="font-weight: 400;font-style: normal;">
                (
                    {{ $ayas->first()->sura->title }}
                    :
                    {{
                        count($ayas) > 1
                        ? $ayas->first()->aya_id . '-' . $ayas->last()->aya_id
                        : $ayas->first()->aya_id
                    }}
                )
            </span>
        </i>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(function () {
            @include('quran.script')
        });
    </script>
@endsection

