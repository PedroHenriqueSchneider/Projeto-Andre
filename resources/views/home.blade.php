@extends('layouts.admin')
@section('content')

<!-- View responśavel pela página em que o usuário vai logo após fazer o login. -->


<div>
  <?php echo "Olá ". $name . ". Seu último login foi " . $login ?>
</div>
@endsection
@section('scripts')
@parent

@endsection