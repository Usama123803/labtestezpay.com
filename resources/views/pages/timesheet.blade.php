<div class="row">
    <?php $restBtnDisabled = ""; ?>
    @if(!$timesheet)
        <?php $restBtnDisabled = "disabled"; ?>
    @endif
    <div class="col-md-12">
        <a href="{{ url('/admin/checkin') }}" class="btn btn-sm {{ $timesheet && $timesheet->check_in ? 'disabled btn-success' : 'btn-primary' }}">Check In</a>
        <a href="{{ url('/admin/checkout') }}" class="btn btn-sm {{ $timesheet && $timesheet->check_out ? 'disabled btn-success' : 'btn-primary' }} {{ $restBtnDisabled }}">Check Out</a>
        <a href="{{ url('/admin/breakin') }}" class="btn btn-sm {{ $timesheet && $timesheet->break_in ? 'disabled btn-success' : 'btn-primary' }} {{ $restBtnDisabled }}">Break In</a>
        <a href="{{ url('/admin/breakout') }}" class="btn btn-sm {{ $timesheet && $timesheet->break_out ? 'disabled btn-success' : 'btn-primary' }} {{ $restBtnDisabled }}">Break Out</a>
    </div>
</div>

<div class="row patient-test-report">
    <div class="col-sm-6">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

{{--            @if ($message)--}}
{{--                <div class="alert alert-success mt-2">--}}
{{--                    {{ $message }}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @if (Session::has('error'))--}}
{{--            <div class="alert alert-danger mt-2">--}}
{{--                {!! Session::get('error') !!}--}}
{{--            </div>--}}
{{--        @endif--}}

        <form method="POST" action="{{ url('admin/test-pdf-report') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" required accept="application/pdf" multiple name="file[]" class="form-control" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn-sm btn btn-primary" value="Upload Patient Test Report" />
            </div>
        </form>
    </div>
</div>

