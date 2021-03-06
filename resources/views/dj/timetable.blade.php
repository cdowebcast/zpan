@extends(Request::ajax() ? 'layouts.ajax-main' : 'layouts.main')

@section('title'){{ _('Timetable') }} @endsection
@section('page-title')DJ <i class="material-icons">chevron_right</i> Timetable @endsection

@section('content')
    <div class="mdl-card mdl-cell mdl-cell--12-col mdl-shadow--2dp">
        <div class="mdl-card__supporting-text">
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect" id="timetable">
                <div class="mdl-tabs__tab-bar">
                    @foreach($timetable as $i => $day)
                        <a href="#{{ $day['name'] }}"
                           class="mdl-tabs__tab {{ $i === (int) session('tab', 0) ? 'is-active' : '' }}">{{ $day['name'] }}</a>
                    @endforeach
                </div>

                @foreach($timetable as $id => $day)
                    <div class="mdl-tabs__panel {{ $id === (int) session('tab', 0) ? 'is-active' : '' }} timetable"
                         id="{{ $day['name'] }}">
                        <ul>
                            @for ($i = 0; $i < 24; $i++)
                                <li>
                                    {{ sprintf('%02d', $i) }}:00 -
                                    @if(empty($day[$i]) || ($day[$i]['id'] === auth()->user()->userid || auth()->user()->isAdmin()))
                                        <form action="{{ route('dashboard::dj::timetable.book') }}" method="post"
                                              class="a-submit" style="display: inline">
                                            {{ method_field(!empty($day[$i]) ? 'delete' : 'put') }}
                                            {{ csrf_field() }}
                                            <input type="hidden" name="day" value="{{ $id }}">
                                            <input type="hidden" name="hour" value="{{ $i }}">
                                            <a href="javascript:void(0)" class="mdl-color-text--primary no-decoration">
                                                {!! !empty($day[$i]) ? $day[$i]['name'] : _('Unbooked') !!}
                                            </a>
                                        </form>
                                    @else
                                        {!! $day[$i]['name'] !!}
                                    @endif
                                </li>
                            @endfor
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
