@component('mail::message')
<h1>
    <strong>
        <center>
            Verify your email account
        </center>
    </strong>
</h1>

Hello ,

Use this code to verify your email:<br>`{{$maildata['code']}}`<br>This code is valid for 5 minutes.

Thanks,<br>
{{ config('app.name') }}

@endcomponent
