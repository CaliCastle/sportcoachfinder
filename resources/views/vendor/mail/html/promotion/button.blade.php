<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        @if(isset($url))
                        <a href="{{ $url }}" class="button button-green" target="_blank">{{ $slot }}</a>
                        @else
                        <span class="button button-green">{{ $slot }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
