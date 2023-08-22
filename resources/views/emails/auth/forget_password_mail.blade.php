<x-mail::message>
    # Password Reset

    Hello,

    You are receiving this email because we received a password reset request for your account.
    To continue with the password reset process for your account, click the button below.
    Verification codes are only valid for a moment, so please update your account password quickly. This code is secret; do not share it with anyone!

    Reset Password: [Reset Password]({{ route('getResetPassword', ['token' => $token]) }})

    If you did not request a password reset, no further action is required.

    Thanks,
    {{ config('app.name') }}
</x-mail::message>

