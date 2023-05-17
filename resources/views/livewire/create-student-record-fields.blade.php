<div class="md:grid grid-cols-12 gap-2">
    <x-input id="admission-number" name="admission_number" label="Admission number *" placeholder="Student's admission number" group-class="col-span-6" />
    <x-input type="date" id="admission-date" name="admission_date" placeholder="Choose student's admission date..." label="Date of admission"  group-class="col-span-6" value="{{old('admission_date')}}"  autocomplete="off" wire:ignore />
</div>
