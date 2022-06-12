@component('mail::message')

{!! $post->body !!}

From,<br>
{{ config('app.name') }}
@endcomponent
