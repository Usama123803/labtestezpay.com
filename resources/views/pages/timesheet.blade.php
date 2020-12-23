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

