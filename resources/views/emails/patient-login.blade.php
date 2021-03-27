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
            Your result is available on your portal, please login to view your results 
            <br>
            Your login credentials are 
        </td>
    </tr>
    <tr>
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
