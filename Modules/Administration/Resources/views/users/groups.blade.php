@extends('administration::layouts.master')

@section('title', 'User\'s Groups - Module Administration')

@section('content')
    <div class="container">
        <h2 class="mx-auto" style="width: 640px;">List of Groups for User: {{ $user->name }} {{ $user->surname }}</h2>
        <form method="POST" action="{{ route('admin.users.groups.update', ['id' => $user->id]) }}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}"/> <!-- TODO: route('admin.users.groups.update') is not sending id -->
            <div class="row">
                <div class="col">
                    <h5>Is Member of</h5>
                    <select size="{{ $high }}" multiple="multiple" id="miembro" name="miembro[]">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">
                                {{ $group->name }}
                                {{ $group->description ? '('.$group->description .')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <div class="row">
                        <input type="button" value="<- Add" onclick="Administracion_moveOptions('disponible', 'miembro');">
                    </div>
                    <div class="row">
                        <input type="button" value="Remove ->" onclick="Administracion_moveOptions('miembro', 'disponible');">
                    </div>
                </div>
                <div class="col">
                    <h5>Available Groups</h5>
                    <select size="{{ $high }}"  multiple="multiple" id="disponible">
                        @foreach($groups_available as $group) // TODO: rename available groups
                            <option value="{{ $group->id }}">
                                {{ $group->name }}
                                {{ $group->description ? '('.$group->description .')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <div class="row">
                        <a class="btn btn-warning"
                           href="{{ route('admin.users.groups', $user->id) }}"
                                {{ insertTagForDuskTesting('link-usersgroups', $user->id, 1) }}
                        >Reload</a>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary" id="submit"
							{{ insertTagForDuskTesting('button-submit') }}
						>Submit</button>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <a id="admin-groups-roles" href="{{ route('admin.groups.roles', '-1') }}">Show list of roles that grant access to the selected group</a><br> <!--Ir a lista de Perfiles para el Grupo seleccionado-->
                    <a id="admin-groups-users" href="{{ route('admin.groups.users', '-1') }}">Show list of users that belong to the selected group</a><br><!--Ir a lista de Usuarios miembros del Grupo seleccionado-->
                    <a id="admin-groups-locations" href="{{ route('admin.groups.locations', '-1') }}">Ir a lista de Localizaciones accesibles para el Grupo seleccionado</a>
                </div>
                <div class="col">
                    Añadir grupo
                </div>
            </div>
        </form>
    </div>

@push('js-scripts')
<script src="{{ asset('js/moveOptions.js') }}"></script>
@endpush
@push('js-scripts-inline')
<script>
    $(document).ready(function() {
        // Replace default dummy param (-1) from links with selected value
        $("[id^='admin-groups-']").on("click", function (e) {
            g = document.getElementById("miembro");
            if (g.selectedIndex == -1) {
                e.preventDefault();
            }

            m = g.options[g.selectedIndex].value;

            url = "{{ route('admin.groups.roles', '*criteria*') }}";
            url = url.replace('*criteria*', m);


            $('#admin-groups-roles').attr('href', url);
        });

        // Select all values in order to submit all of them
        $("#submit").on("click", function (e) {
            var miembro=document.getElementById("miembro");
            for (var i = 0; i < miembro.options.length; i++)
                miembro.options[i].selected =true;
        });

    });
</script>
@endpush
@stop