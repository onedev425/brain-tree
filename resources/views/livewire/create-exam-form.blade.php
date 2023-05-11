<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create exam </h3>
    </div>
    <div class="card-body">
        <form action="{{route('exams.store')}}" method="POST" class="md:w-6/12">
            <x-display-validation-errors/>
            <p class="text-secondary">
                {{__('All fields marked * are required')}}
            </p>
            <x-input id="name" name="name" label="Exam Name *" placeholder="Enter Exam name"/>
            <x-textarea id="description" name="description" label="Description " placeholder="Enter description" />
            @csrf
            <x-button label="Create" icon="fas fa-key" type="submit" class="w-full md:w-6/12"/>
        </form>
    </div>
</div>