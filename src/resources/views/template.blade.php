@php
    /**
     * @var \ArtisanLabs\LaravelRouter\Models\RouteModel[]|\ArtisanLabs\LaravelRouter\Models\RouteGroupModel[] $itens
     */
@endphp
@foreach($itens as $item)
    @if(get_class($item) == \ArtisanLabs\LaravelRouter\Models\RouteGroupModel::class)@include("router::group", compact("item"))@elseif(get_class($item) == \ArtisanLabs\LaravelRouter\Models\RouteModel::class)@include("router::route", compact("item"))@endif
@endforeach
