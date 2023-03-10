<button style="display: {{$user->role_name == 'user' ? 'none' : 'block'}};" class="@if(empty($hideDefaultClass) or !$hideDefaultClass) btn-transparent text-primary @endif {{ $btnClass ?? '' }}"
        data-confirm="{{ trans('admin/main.delete_confirm_msg') }}"
        data-confirm-href="{{ $url }}"
        data-confirm-text-yes="{{ trans('admin/main.yes') }}"
        @if(empty($btnText))
        data-toggle="tooltip" data-placement="top" title="{{ !empty($tooltip) ? $tooltip : trans('admin/main.delete') }}"
    @endif
>
    @if(!empty($btnText))
        {{ $btnText }}
    @else
        <i class="fa {{ !empty($btnIcon) ? $btnIcon : 'fa-times' }}" aria-hidden="true"></i>
    @endif
</button>
