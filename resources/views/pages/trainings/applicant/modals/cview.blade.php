@php use App\Helper\MyHelper; @endphp
<div id="modal_calendar_view" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Calendar View</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-calendar">
                    <div class="full-calendar" id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
