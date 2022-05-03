@extends('corporate::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\EditFacade::display('corporate', 'corporate-general-term', $corporateGeneralTerm->id)}}
@endsection