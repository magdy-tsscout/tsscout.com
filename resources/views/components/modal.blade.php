@props(['modal_id', 'content', 'width' => '90%'])
<div class="modal fade" id="{{ $modal_id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" style="min-width: {{ $width }};">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @isset($content)
                {!! $content !!}
                @endisset
                {{ $slot }}
            </div>

        </div>
    </div>
</div>
