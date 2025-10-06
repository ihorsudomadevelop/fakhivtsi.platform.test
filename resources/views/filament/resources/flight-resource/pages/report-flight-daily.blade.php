@php use App\Models\Flight; @endphp
<div>
	@foreach($flights as $flight)
		@php
			/*** @var Flight $flight */
		@endphp
		<div style="margin: 8px; padding: 4px">
			<b>~Виліт №{{ $flight->flight_number }}</b>
			<br>
			Час: {{ $flight->flight_time_start }} - {{ $flight->flight_time_end }}
			<br>
			Ціль: {{ $flight->target }}
			<br>
			Координати: 37U CP {{ $flight->coordinates }}
			<br>
			Статус: {{ $flight->target_status }}
			<br>
			БК: @foreach($flight->getAmmunition() as $ammunition)
				{{ $ammunition['title'] }} - {{ $ammunition['quantity'] }}шт
			@endforeach
		</div>
	@endforeach
</div>