{!! clean($aya->text) !!}
<div
    class="aya-number"
>
    {{ Html::image('/img/aya-number-frame.png') }}
    <div class="number text-center">{{ ar($aya->aya_id) }}</div>
</div>