<div class="card">
    <div class="card-header">
        <h4 class="card-title">Result Checker</h4>
    </div>
    <div class="card-body">
        @if (!auth()->user()->hasRole('student'))
            <x-display-validation-errors/>
            <x-loading-spinner/>
            {{-- form for selecting students to display --}}
            <form wire:submit.prevent="checkResult('{{$student}}')" class="">
                <div class="md:flex gap-4 items-end">
                    @hasanyrole('super-admin|admin|teacher')
                    @endhasanyrole
                    <x-select id="student" name="student" label="Student"  wire:model="student" group-class="md:w-3/12">
                        @isset($students)
                            @foreach ($students as $item)
                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        @endisset
                    </x-select>
                </div>
                    
                <x-button label="Check result" theme="primary" type="submit" class="w-full md:w-3/12"/>
            </form>
        @endif
        @if ($preparedResults == true)
            @isset($exams)
                @foreach ($exams as $exam)
                <h3 class="md:text-xl font-bold text-center my-2">{{$studentName}}'s result in {{$exam->name}}</h3>
                    @if (!$exam->examSlots  ->isEmpty())
                        <div class="overflow-scroll beautify-scrollbar">
                            <table class="w-full " style="white-space: nowrap">
                                <tr>
                                    <th class="text-blue-500 border p-4">Subject</th>
                                    @foreach ($exam->examSlots as $examSlot)
                                        <th class="border p-4">{{$examSlot->name}} ({{$examSlot->total_marks}})</th>
                                    @endforeach
                                    <th class="text-green-500 border p-4">Total ({{$exam->examSlots->pluck('total_marks')->sum()}})</th>
                                </tr>
                            </table>
                        </div>
                    @else
                        <p>No exam records found</p>
                    @endif   
                @endforeach
            @endisset
        @elseif (isset($status))
            <P>{{$status}}</P>
        @endif
    </div> 
</div>
