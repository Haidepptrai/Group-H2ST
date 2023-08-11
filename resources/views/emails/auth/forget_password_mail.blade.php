<x-mail::message>
    # Password Reset
    <p>Hello</p>
    You are receiving this email because we received a password reset request for your account.
    To continue with the password reset process for your account, click the button below.
    Verification codes are only valid for a moment, update your account password quickly. This code is secret do not share with anyone!
    <x-mail::button :url="route('getResetPassword', ['token' => $token])">
        Reset Password
    </x-mail::button>

    If you did not request a password reset, no further action is required.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>

