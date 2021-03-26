<table>
    <thead>
    <tr>
        <td>Dear {{ $patient->first_name }} {{ $patient->last_name }}</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <br>
            Your Appointment is confirmed please come on
            <strong>{{ \Carbon\Carbon::parse($patient->appointment)->format('m/d/Y') }}</strong> -
            <strong>{{ $patient->timeslot }}</strong>
        </td>
    </tr>
    <tr>
{{--        <td><strong>Username:</strong> {{ $patient->first_name }}.{{ $patient->last_name }}</td>--}}
        <td><strong>Email:</strong> {{ $patient->email_address }}</td>
    </tr>
    <tr>
        <td><strong>Password:</strong> {{ \Carbon\Carbon::parse($patient->dob)->format('Ydm') }}</td>
    </tr>

    </tbody>
    <tfoot>
    <tr>
        <td>
            <p>Sincerely,</p>
{{--            <p>The {{ config('site.company_name') }} Sales Team</p>--}}
        </td>
    </tr>
    </tfoot>
</table>
