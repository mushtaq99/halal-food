<x-layout>

    <div class="container mt-5 bg-white" style="width: 600px; padding: 3rem;" >

        <h2 class="mb-5">Create new role</h2>

        @if(count($errors->all()))
            <ul>
            @foreach($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        <form action="/roles/{{$role['id']}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group mb-4">
                <label class="mb-1" for="name">Name</label>
                <input name="name"  class="form-control" id="name" value="{{ $role['slug'] }}">
            </div>

            <div class="form-group mb-4">
                <label class="mb-1" for="name">Attach permissions</label>

                <select name="permissions[]" id="permissions" class="form-control" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', $attachedPermissions)) ? 'selected' : '' }}>{{ $permission->slug }}</option>
                    @endforeach
                </select>

                @error('permissions')
                <p class="text-danger text-sm">{{ $message }}</p>
                @enderror

            </div>

            <x-button label="Update" />
        </form>
    </div>
</x-layout>
