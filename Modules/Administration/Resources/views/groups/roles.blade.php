@extends('administration::layouts.master')

@section('title', 'Group\'s Roles - Module Administration')

@section('content')
    <div class="container">
        <h2 class="mx-auto" style="width: 640px;">List of Roles for Group: {{ $group->name }} {{ $group->surname }}</h2>
		<form method="POST" action="{{ route('admin.groups.roles.update', ['id' => $group->id]) }}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{ $group->id }}"/> <!-- TODO: route('admin.users.groups.update') is not sending id -->
	        <div class="row">
	            <div class="col">
	                <h5>Has Roles</h5>
	                <select size="{{ $high }}" multiple="multiple" id="miembro" name="miembro[]">
	                    @foreach($roles as $role)
	                        <option value="{{ $role->id }}">
	                            {{ $role->name }}
	                            {{ $role->description ? '('.$role->description .')' : '' }}
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
	                <h5>Available Roles</h5>
	                <select size="{{ $high }}"  multiple="multiple" id="disponible">
	                    @foreach($roles_available as $role)
	                        <option value="{{ $role->id }}">
	                            {{ $role->name }}
	                            {{ $role->description ? '('.$role->description .')' : '' }}
	                        </option>
	                    @endforeach
	                </select>
	            </div>
	            <div class="col">
	                <div class="row">
						<a class="btn btn-warning"
                           href="{{ route('admin.groups.roles', $group->id) }}"
                                {{ insertTagForDuskTesting('link-groupsroles', $group->id, 1) }}
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
					<a id="admin-roles-modules" href="{{ route('admin.roles.modules', '-1') }}">Ir a lista de Modulos que autoriza el Perfil seleccionado</a><br>
					<a id="admin-roles-groups" href="{{ route('admin.roles.groups', '-1') }}">Ir a lista de Grupos autorizados por el Perfil seleccionado</a><br>
				</div>
	            <div class="col">
	                Añadir Modulo
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
        $("[id^='admin-roles-']").on("click", function (e) {
debugger;
            g = document.getElementById("miembro");
            if (g.selectedIndex == -1) {
                e.preventDefault();
            }

            m = g.options[g.selectedIndex].value;

            url = "{{ route('admin.groups.roles', '*criteria*') }}"; // TODO Unify
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