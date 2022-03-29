@php
    /**
     * @var \DevApex\LaravelRouter\Models\RouteModel[]|\DevApex\LaravelRouter\Models\RouteGroupModel[] $itens
     */
@endphp
@foreach($itens as $item)
    @if(get_class($item) == \DevApex\LaravelRouter\Models\RouteGroupModel::class)@include("router::group", compact("item"))@elseif(get_class($item) == \DevApex\LaravelRouter\Models\RouteModel::class)@include("router::route", compact("item"))@endif
@endforeach
