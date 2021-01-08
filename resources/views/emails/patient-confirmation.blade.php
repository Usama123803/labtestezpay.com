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
            Your Appointment is confirmed please come on <strong>{{ \Carbon\Carbon::parse($patient->appointment)->format('m/d/Y') }}</strong> -  <strong>{{ $patient->timeslot }}</strong>
        </td>
    </tr>
    <tr>
        <td>
        <br>
            Find below some useful links for further guidance.
            <br>
            https://www.cdc.gov/coronavirus/2019-ncov/if-you-are-sick/steps-when-sick.html
            <br>
            https://www.cdc.gov/coronavirus/2019-ncov/hcp/duration-isolation.html#:~:text=For%20most%20persons%20with%20COVID,with%20improvement%20of%20other%20symptoms.
        </td>
    </tr>
    <tr>
        <td>
        <br>
            -----------------------------------------------
            Confidentiality Statement:  This email is confidential.  The information herein is intended only for the person or entity to which it is addressed and may contain confidential and/or privileged material.  Any review, re-transmission, dissemination, or other use of this information by persons or entities other than the intended recipient is prohibited.  If you are not the intended recipient, you must not disclose or use the information contained in the email. If you have received this email in error, please contact the sender immediately and delete the document.
        </td>
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
