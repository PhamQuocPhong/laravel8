<div class="row"> 
  <div class="col-md-12"> 
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade in m-4">
        <a href="javascript:void(0)" target="_self" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
  </div>
</div>