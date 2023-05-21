@hasanyrole('super-admin')
    <div class="card">
        <div class="card-body">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @can('read student')
                    <x-info-box title="{{$students}}" text="Students (active)" icon=" text-dark" theme="yellow" url="{{route('students.index')}}" url-text="View students" colour="bg-blue-700"  text-colour="text-white"/>
                @endcan
                @can('read teacher')
                    <x-info-box title="{{$teachers}}" text="Teachers" icon=" text-dark" theme="orange" url="{{route('teachers.index')}}" url-text="View teachers" colour="bg-indigo-700"  text-colour="text-white"/>
                @endcan
            </div>
        </div>
    </div>
@endhasanyrole
