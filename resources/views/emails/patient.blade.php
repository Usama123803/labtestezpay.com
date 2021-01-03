<table>
    <thead>
    <tr>
        <td>Dear {{ $patient->first_name }} {{ $patient->last_name }}</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            Please see the attached document for your test results.
        </td>
    </tr>
    <tr>
        <td>
            Confidentiality Statement:  This email is confidential.  The information herein is intended only for the person or entity to which it is addressed and may contain confidential and/or privileged material.  Any review, re-transmission, dissemination, or other use of this information by persons or entities other than the intended recipient is prohibited.  If you are not the intended recipient, you must not disclose or use the information contained in the email. If you have received this email in error, please contact the sender immediately and delete the document.
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td>
            <p>Best Regards,</p>
{{--            <p>The {{ config('site.company_name') }} Sales Team</p>--}}
        </td>
    </tr>
    </tfoot>
</table>
