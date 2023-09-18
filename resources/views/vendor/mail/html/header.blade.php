<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://recyclebankegypt.com/images/app/logo.jpg" class="logo" alt="recyclebankegypt Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
