@extends('layouts.admin')

@section('admin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom noprint">   
        <h3 >Listado Trabajadores</h3>    
        <form class="no-print signin-form" method="POST" action="{{ route('admin') }}">
            @csrf
            <div class="form-group">	            
            </div>
            <div class="input-group w-50">
                <button type="submit" class="btn">
                    <span class="input-group-text" id="basic-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                    </svg>
                    </span>
                </button>
                    <input type="date" class="btn btn-sm btn-outline-secondary " name="date" placeholder="Seleccione una fecha" >	
              
            </div>
                
        </form>
        <!-- <input type="date" name="date" placeholder="Seleccione una fecha" > -->

    </div>
    <div class="table-responsive">
        <table class="table table-striped rounded">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Email</th>
              <th scope="col">Estado</th>
              <th scope="col">Fecha</th>
              <th scope="col">Hora</th>
            </tr>
          </thead>
          <tbody>

              @foreach ($trabajadores as $trabajador)
              <tr>
              <td>{{$trabajador->usua_nomb}}</td>
              <td>{{$trabajador->usua_email}}</td>
              <td>{{$trabajador->estado}}</td>
              <td>{{$trabajador->fecha_registro}}</td>
              <td>{{$trabajador->hora_resgistro}}</td>
              </tr>
              
              @endforeach
            
           
          </tbody>
        </table>
      </div>

      <button type="button" class="no-print btn btn-warning d-fixed" onClick="print()">Imprimir</button>
@endsection