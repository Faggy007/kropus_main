@extends('errors.layout')
@section('errorCode', '404')
@section('errorTitle', 'Страница не найдена')
@section('errorMessage')
    К сожалению, страница, которую вы ищете, не найдена. <br class="hidden lg:block"> Возможно, она была удалена или перемещена на другой адрес.
@endsection

