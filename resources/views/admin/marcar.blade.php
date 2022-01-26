@extends('layouts.admin')

@section('admin')

    <div class="row justify-content-center">
        <div class=" card">
            <div class="card-header">Asistencia Laboral</div>
            <div class="card-body">
                <div class="">
                    <div class="w-100">
                        <h3 class="mb-4">Bienvenido {{ auth()->user()->usua_nomb }}
                        </h3>
                    </div>
                </div>
                
                <form class="signin-form" method="POST" action="{{ route('admin.registrar') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="id" value="{{ auth()->user()->usua_codi }}" hidden>
                        <button type="submit" class="btn btn-outline-success px-3">Marcar</button>	            
                    </div>
        
                </form>
                <div>
                    <p>
                        Ultimo marcacion registrada: 
                        <b><?php echo $fecha;?> <?php echo $hora;?> </b> 
                    </p>   
                </div >
                            
            </div>
        </div>
                
    </div>
            
@endsection