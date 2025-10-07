

	<x-filament::button
			color="primary"
			tag="a"
{{--			href="{{ route('shift.edit', $record) }}"--}}
	>
		Редагувати
	</x-filament::button>

	<x-filament::button
			color="danger"
{{--			wire:click="$emit('deleteShift', {{ $record->id }})"--}}
	>
		Видалити
	</x-filament::button>



