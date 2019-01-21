<!-- will be used to show search form&button bar -->
<div class="row">
    <div class="col-sm">
        <a class="btn btn-small btn-info" href="{{ route('admin.'.$onObject.'.create') }}">Create a New User</a>
    </div>
    <div class="col-sm">
        <form class="form-inline justify-content-end" method="GET" action="{{ route('admin.'.$onObject.'.criteria', '%') }}" id="searchform">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="criteria" value="{{ $criteria }}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="searchbutton">Search</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#searchbutton").on("click", function (e) {
            var url;
            var criteria = document.getElementById('criteria').value;

            if (criteria === '') {
                url = "{{ route('admin.'.$onObject.'.index') }}";
            } else {
                url = "{{ route('admin.'.$onObject.'.criteria', '*criteria*') }}";
                url = url.replace('*criteria*', criteria);
            }
            console.log(criteria);
            console.log(url);

            $('#searchform').attr('action', url).submit();
            e.preventDefault();
        });
    });
</script>