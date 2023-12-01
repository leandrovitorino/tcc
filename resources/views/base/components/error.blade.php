@forelse($errors->all() as $error)
    <div class="col-md-12">
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    </div>
@empty
@endforelse

@if(session('success'))
    <div class="col-md-12">
        <div class='alert alert-success alert-block' role='alert'>
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('success') }}</strong>
        </div>
    </div>
@endif

@if(session('info'))
    <div class="col-md-12">
        <div class="alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('info') }}</strong>
        </div>
    </div>
@endif

@if(session('warning'))
    <div class="col-md-12">
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('warning') }}</strong>
        </div>
    </div>
@endif
