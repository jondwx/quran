@extends('layout.quran')

@section('og-title', 'Quran ~ '. $title)
@section('title', 'Quran ~ '. $title)

@section('meta')
    @if (url()->current() === url('/64/3'))
    <meta
        property="og:image"
        content="{{ asset('/img/ss/quran-64-3.jpg') }}" />
    @endif
@endsection

@section('ayas')
    @foreach ($ayas as $aya)
        <?php
            $ars[] = view('quran.aya', ['aya' => $aya])->render();
            $ids[] = view('quran.aya-id', ['aya' => $aya])->render();
        ?>
    @endforeach
    <div class="view">
        <div class="background-image"></div>
        <div class="content">
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
                    ({{ $title }})
                </span>
            </i>
        </div>
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

