@php
    $id = rand(100000, 999999);
@endphp
<div class="card">
    <div class="card-header" id="heading-{{$id}}">
        <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse"
            data-target="#collapse{{$id}}"
            aria-expanded="false" aria-controls="collapse{{$id}}">
                {{$name}}
                <i class="la la-angle-down narrow-icon float-right"></i>
            </button>
        </h5>
    </div>

    <div id="collapse{{$id}}" class="collapse"
    aria-labelledby="heading{{$id}}"
    data-parent="#accordion">
        <div class="card-body">
            <form method="GET">
                <input type="hidden" class="form-control" name="type" value="breaker">
                <div class="form-group">
                    <label for="label">Enter Label</label>
                    <input type="text" class="form-control" name="label" placeholder="Label Separator">
                </div>
                @if(!empty($roles))
                <div class="form-group">
                    <label for="role">Select Role</label>
                    <select class="form-control" name="role">
                        <option value="0">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->$role_pk }}">
                                {{ ucfirst($role->$role_title_field) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <button type="button" onclick="addItemMenu(this, 'default')"
                    class="btn btn-info btn-sm float-right mr-2 mb-2">
                        Add to Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
