@hasanyrole('admin|super-admin')
    <div class="card">
        <div class="card-body">
            @can('read school')
                <h2 class="font-bold text-center text-2xl my-2 ">Multi schools</h2>
                <div>
                    <x-info-box :title="$schools" text="Schools" icon="fas fa-school text-dark" colour="bg-red-600" text-colour="text-white" :url="route('schools.index')" url-text="View schools"/>
                </div>
            @endcan
            
            @can('manage school settings')
                <h4 class="font-bold text-center text-2xl my-4">School data</h4>
            @endcan
        
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
