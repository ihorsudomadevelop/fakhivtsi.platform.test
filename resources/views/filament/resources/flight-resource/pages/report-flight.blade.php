<div x-data="{ copied: false }" class="space-y-4">
	<div id="reportText">
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
	</div>

	<div class="flex items-center gap-3">
		<x-filament::button
				type="button"
				color="primary"
				x-on:click="
                navigator.clipboard.writeText(
                    document.getElementById('reportText').innerText
                ).then(() => copied = true)
            "
		>
			Скопіювати
		</x-filament::button>
		<span x-show="copied" x-transition class="text-sm text-green-600">
            Скопійовано!
        </span>
	</div>
</div>
