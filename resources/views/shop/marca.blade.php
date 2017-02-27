@extends('layouts.master')

@section('title',$title->nombre)

@section('content')
<section>
    <div class="container">
        <div class="row">
            @include('partials.leftsidebar')
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">{{$title->nombre}}</h2>
                    @include('partials.productos')
                    
                    <ul class="pagination">
                        {{ $products->links() }}
                    </ul>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection