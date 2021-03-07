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
            you're agree with following term and conditions.
            <br>
            I authorize this COVID-19 testing unit to conduct collection and testing for COVID-19 through a nasopharyngeal swab or blood draw, as ordered by an authorized medical provider or public health official.
            <br>
            I authorize my test results to be disclosed to the county, state, or to any other governmental entity as may be required by law.
            <br>
            I acknowledge that a positive test result is an indication that I must self-isolate and/or wear a mask or face covering as directed to avoid infecting others
            <br>
            I understand the testing unit is not acting as my medical provider, this testing does not replace treatment by my medical provider, and I assume complete and full responsibility to take appropriate action with regards to my test results.
            <br>
            I agree that I will seek medical advice, care, and treatment from my medical provider if I have questions or concerns, or if my condition worsens.
            <br>
            I understand that, as with any medical test, there is the potential for a false positive or false negative COVID-19 test result. I have been informed about the test purpose, procedures, possible benefits. I understand that I can get the copy of this informed consent on the request. I have been given the opportunity to ask questions before I agree, and I have been told that I can ask additional questions at any time. I voluntarily agree to this COVID-19 testing.
            <br>
            Furthermore, I understand the potential risks of this procedure including but not limited to possible discomfort or other complications that can happen during sample collection, possible false positive, false negative or inconclusive test results.
            <br>
            By agreeing to our terms and conditions the guardians of under age children are consenting our staff to collect the specimen (blood or nasal as the case may be) needed for the particular tests
            <br>
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
