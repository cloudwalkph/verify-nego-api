<div class="col-sm-12 form-horizontal">
    @include('components.errors')

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="name" required
                       value='{{ isset( $project->name ) ? $project->name : "" }}'/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="user[][id]">Assign User</label>
            <div class="col-sm-10">
                <select name="user[][id]" id="users">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->profile->getFullNameAttribute() }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-12" style="text-align: right;">
        <a href="/admin/projects" class="btn btn-default">
            <i class="fa fa-arrow-left fa-lg"></i> Back
        </a>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check fa-lg"></i> Save
        </button>
    </div>

</div>

@section('scripts')
    <script>
        $(function() {
            $('#users').selectize({
                maxItems: null,
                sortField: 'text'
            });
        });
    </script>
@endsection
