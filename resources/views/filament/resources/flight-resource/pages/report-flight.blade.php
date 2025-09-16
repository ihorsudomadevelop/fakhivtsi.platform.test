<div>
	~Виліт №{{ $record->flight_number }}
	<br>
	Час: {{ $record->flight_time_start }} - {{ $record->flight_time_end }}
	<br>
	Ціль: {{ $record->target }}
	<br>
	Координати: 37U CP {{ $record->coordinates }}
	<br>
	Статус: {{ $record->target_status }}
	<br>
	БК: {{ $record->ammunition }}
</div>